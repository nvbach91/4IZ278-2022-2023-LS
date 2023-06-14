$(document).ready(function() {
    var apiDomain = '../apiftpklient.patriktrejtnar.cz';

    var currentDirectory = '/';
    var user = null;
    var accesses = null;

    $('#FTPTable').hide();



    var table = $('#filesTable').DataTable({
        columns: [
            { data: 'name' }
        ]
    });

    $('#ftpForm').on('submit', function(e) {
        e.preventDefault();

        ftpConnect();
    });

    $('#ftpForm save').on('submit', function(e) {
        e.preventDefault();

        ftpConnect();
    });

    $('#userRegisterForm').on('submit', function(e) {
        e.preventDefault();

        userRegister();
    });

    $('#userLoginForm').on('submit', function(e) {
        e.preventDefault();

        userLogin();
    });



    $('#filesTable tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        if (data.isDirectory) {
            change(currentDirectory + "/" + data.name);
        }else {
            download(data.name);
        }
    });

    function change(directory) {
        $.ajax({
            url: apiDomain + '/action/change.php',
            method: 'POST',
            headers: {
                'X-API-Key': 'f5c9d143-7622-4122-9725-65ef38f48559'
            },
            contentType: "application/json",
            data: JSON.stringify({
                directory: directory,
            }),
            success: function(data) {
                drawData(data)
            }
        });
    }

    function download(file) {
        $.ajax({
            url: apiDomain + '/action/download.php',
            method: 'POST',
            headers: {
                'X-API-Key': 'f5c9d143-7622-4122-9725-65ef38f48559'
            },
            contentType: "application/json",
            data: JSON.stringify({
                file: file,
            }),
            success: function(data) {

                var link = document.createElement('a');
                link.href = apiDomain + "/file/" + file;
                link.download = file;
                link.click();
                ftpDeleteLocalFile(file)
            }
        });
    }

    document.getElementById("fileUpload").addEventListener("change", function(event){
        ftpUploadFile(this.files[0]);
    });

    function ftpUploadFile(file) {
        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            url: apiDomain + '/action/ftp/uploadFile.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                change(currentDirectory);
            }
        });
    }




    function ftpDeleteLocalFile(file) {
        $.ajax({
            url: apiDomain + '/action/ftp/deleteLocalFile.php',
            method: 'DELETE',
            contentType: "application/json",
            data: JSON.stringify({
                file: file,
            }),
            success: function(data) {


            }
        });
    }


    function ftpConnect() {
        var server = $('#server').val();
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: apiDomain + '/action/ftp/connect.php',
            method: 'POST',
            contentType: "application/json", //přidání contentType
            data: JSON.stringify({ //data konvertována na JSON
                server: server,
                username: username,
                password: password
            }),
            success: function(data) {
                $('#FTPTable').show();
                drawData(data)
                if(user != null){
                    accessSave(server,username,password)
                }
            }
        });
    }

    function userRegister() {
        var user_email = $('#user_email').val();
        var user_password = $('#user_password').val();
        var user_passwordAgain = $('#user_passwordAgain').val();

        if (user_password !== user_passwordAgain) {
            alert("Hesla se neshodují. Zkontrolujte je a zkuste to znovu.");
            return;  // Přeruší zpracování funkce
        }

        $.ajax({
            url: apiDomain + '/action/user/register.php',
            method: 'POST',
            headers: {
                'X-API-Key': 'f5c9d143-7622-4122-9725-65ef38f48559'
            },
            contentType: "application/json", //přidání contentType
            data: JSON.stringify({ //data konvertována na JSON
                user_email: user_email,
                user_password: user_password,
            }),
            success: function(data) {
                alert("Byl jste úspěšně zaregistrován, můžete se přihlásit");
            }
        });
    }

    function userLogin() {
        var user_email = $('#login_user_email').val();
        var user_password = $('#login_user_password').val();
        var user_passwordAgain = $('#user_passwordAgain').val();

        // Kontrola shodnosti hesel


        $.ajax({
            url: apiDomain + '/action/user/login.php',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify({ //data konvertována na JSON
                user_email: user_email,
                user_password: user_password,
            }),
            success: function(data) {
                user = data.user;
                displayUserLoginStatus(user)
                accessList()

            }
        });
    }

    function accessList() {

        $.ajax({
            url: apiDomain + '/action/userAccess/list.php',
            method: 'POST',
            headers: {
                'X-API-Key': 'f5c9d143-7622-4122-9725-65ef38f48559'
            },
            contentType: "application/json", //přidání contentType
            success: function(data) {
                accesses = data.accessList;
                displayAccessNames(accesses)
            }
        });
    }

    function userLogout() {

        $.ajax({
            url: apiDomain + '/action/user/logout.php',
            method: 'GET',
            headers: {
                'X-API-Key': 'f5c9d143-7622-4122-9725-65ef38f48559'
            },
            contentType: "application/json", //přidání contentType
            success: function(data) {
                user = data.user;
                displayUserLoginStatus(user)
                accesses = data.accessList;
                displayAccessNames(accesses)
            }
        });
    }

    function accessSave(access_server,access_username,access_password) {

        $.ajax({
            url: apiDomain + '/action/access/save.php',
            method: 'POST',
            data: JSON.stringify({ //data konvertována na JSON
                access_server: access_server,
                access_username: access_username,
                access_password: access_password,

            }),
            contentType: "application/json", //přidání contentType
            success: function(data) {
                accessList()

            }
        });
    }

    function accessDelete(id_access) {

        $.ajax({
            url: apiDomain + '/action/access/delete.php',
            method: 'DELETE',
            data: JSON.stringify({ //data konvertována na JSON
                id_access: id_access,
            }),
            contentType: "application/json", //přidání contentType
            success: function(data) {
                accessList()

            }
        });
    }


    function drawData(data) {
        if (data.files && data.files.length > 0) {

            // Clear the table first
            table.clear();

            // Add the go-up row
            table.row.add({ name: '..' }).draw().node().classList.add('go-up');

            // Add the rest of the files
            table.rows.add(data.files).draw();

            if (data.currentDirectory) {
                $('#currentDirectory').text(data.currentDirectory);
                currentDirectory = data.currentDirectory;
            }
        }
    }



    function displayAccessNames(accessList) {
        var ul = document.getElementById('accessList');

        ul.innerHTML = '';

        // Projdeme seznam přístupů
        accessList.forEach(function(access) {
            // Pro každý přístup vytvoříme nový list item
            var li = document.createElement('li');
            li.className = "nav-item";

            // Vytvoříme nový odkaz
            var a = document.createElement('a');
            a.href = "#";
            a.className = "nav-link";
            a.setAttribute("aria-current", "page");
            a.textContent = access.access_name;

            li.appendChild(a);

            a.addEventListener('click', function(e) {
                e.preventDefault();

                $('#FTPModal').modal('show');

                $('#server').val(access.access_server);
                $('#username').val(access.access_username);
                $('#password').val(access.access_password);
                $('#id_access').val(access.id_access);

                // Zde přiřazujeme událost click tlačítku deleteAccess
                $('#deleteAccess').off('click').on('click', function() {
                    accessDelete(access.id_access);
                });
            });

            ul.appendChild(li);
        });
    }






    function displayUserLoginStatus(user) {
        var userLoginStatus = document.getElementById('userLoginStatus');

        userLoginStatus.innerHTML = '';

        if (user === null) {
            userLoginStatus.innerHTML = `
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Přihlásit se /  Registrovat se
            </button>
        `;
        } else {
            userLoginStatus.innerHTML = `
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong id="user">${user.user_email}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" id="userLogout">Sign out</a></li>
                </ul>
            </div>
        `;
            document.getElementById('userLogout').addEventListener('click', userLogout);
        }
    }







    $(document).on('click', '.go-up', function(e){
        e.preventDefault();

       change('..')
    });

});







