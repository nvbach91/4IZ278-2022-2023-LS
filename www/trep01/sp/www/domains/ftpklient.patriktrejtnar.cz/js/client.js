$(document).ready(function() {
    var apiDomain = '../apiftpklient.patriktrejtnar.cz';

    var currentDirectory = '/';
    var user = null;
    var accesses = null;

    $('#FTPTable').hide();


    var table = $('#filesTable').DataTable({
        columns: [
            { data: 'name' },
            { data: "action" }
        ]
    });

    document.getElementById("fileUpload").addEventListener("change", function(event){
        ftpUploadFile(this.files[0]);
    });


    $('#ftpForm').on('submit', function(e) {
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


    $('#filesTable tbody').on('click', 'td:first-child', function() {
        var data = table.row(this).data();
        if (data.isDirectory) {
            change(currentDirectory + "/" + data.name);
        }else {
            download(data.name);
        }
    });

    $('#filesTable tbody').on('click', 'tr.directory-row', function() {
        var data = table.row(this).data();
        change(currentDirectory + "/" + data.name);
    });

    $('#filesTable tbody').on('click', '.file-row button.file-preview', function(e) {
        e.stopPropagation();
        displayFileContent($(this).data('filename'));
    });





    function change(directory) {
        $.ajax({
            url: apiDomain + '/action/change.php',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify({
                directory: directory,
            }),
            success: function(data) {
                drawData(data)
                showResponse(data)
            }
        });
    }

    function accessShare(id_access,email){
        var id_access = $('#id_access').val();

        if(id_access.trim() === "") {
            id_access = null;
        }

        $.ajax({
            url: apiDomain + '/action/userAccess/add.php',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify({
                id_access: id_access,
                email: email,
            }),
            success: function(data) {
                showResponse(data)
            }
        });
    }

    function download(file, show = true) {
        $.ajax({
            url: apiDomain + '/action/download.php',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify({
                file: file,
            }),
            success: function(data) {

                var filePath = apiDomain + "/file/" + file;

                var fileExtension = filePath.split('.').pop().toLowerCase();

                if (['txt', 'js', 'css', 'html', 'json', 'xml', 'csv', 'md', 'php', 'py', 'c', 'cpp', 'java', 'cs'].includes(fileExtension) && show) {
                    displayFileContent(filePath)
                }else{
                    var link = document.createElement('a');

                    link.href = apiDomain + "/file/" + file;
                    link.download = file;
                    link.click();
                    showResponse(data)
                    ftpDeleteLocalFile(file)
                }
            }
        });
    }


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
                showResponse(data)
            }
        });
    }


    function ftpConnect() {
        var server = $('#server').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var id_access = $('#id_access').val();

        if(id_access.trim() === "") {
            id_access = null;
        }

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

                if(user != null){
                    if(id_access == null)
                    accessSave(server,username,password,id_access)
                }
                if(!data.error){
                    $('#FTPTable').show();
                    drawData(data)
                }
                showResponse(data)
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
            contentType: "application/json", //přidání contentType
            data: JSON.stringify({ //data konvertována na JSON
                user_email: user_email,
                user_password: user_password,
            }),
            success: function(data) {
                showResponse(data)
            }
        });
    }

    function userLogin() {
        var user_email = $('#login_user_email').val();
        var user_password = $('#login_user_password').val();

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
                showResponse(data)
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

    function accessSave(access_server,access_username,access_password,id_access) {

        $.ajax({
            url: apiDomain + '/action/access/save.php',
            method: 'POST',
            data: JSON.stringify({ //data konvertována na JSON
                access_server: access_server,
                access_username: access_username,
                access_password: access_password,
                id_access: id_access,

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
            table.clear();

            var goUpRow = table.row.add({ name: '..', action: ''}).draw().node();
            goUpRow.classList.add('go-up');

            data.files.forEach(function(file) {
                var actions = file.isDirectory ? '' :
                    '<button class="btn btn-info file-preview" data-filename="' + apiDomain + '/file/' + file.name + '">Náhled</button> ' +
                    '<a class="btn btn-warning" onclick="download(\'' + apiDomain + '/file/' + file.name + '\')" id="fDownload" href="' + apiDomain + '/file/' + file.name + '" download="' + file.name + '">Download</a>';

                var row = table.row.add({
                    name: file.name,
                    action: actions
                }).draw().node();

                if (file.isDirectory) {
                    row.classList.add('directory-row');
                } else {
                    row.classList.add('file-row');
                }
            });

            if (data.currentDirectory) {
                $('#currentDirectory').text(data.currentDirectory);
                currentDirectory = data.currentDirectory;
            }

            // add click event listener to file preview buttons
            $('.file-preview').click(function(e) {
                e.stopPropagation(); // stop the click event from bubbling
                displayFileContent($(this).data('filename'));
            });
        }
    }






    function displayFileContent(filePath) {
        // Use AJAX to get the file content
        $.get(filePath, function(fileData) {
            // Split the file path to get the file name
            var fileName = filePath.split('/').pop();

            // Update the file content and download link
            $('#fileContent').text(fileData);
            $('#fileDownload').attr('href', filePath);
            $('#fileDownload').attr('download', fileName);

            // Update the modal title
            $('#fileModal .modal-title').text('File Content: ' + fileName);

            // Show the modal
            $('#fileModal').modal('show');
        });
    }



    function displayAccessNames(accessList) {
        var ul = document.getElementById('accessList');

        ul.innerHTML = '';

        accessList.forEach(function(access) {
            var li = document.createElement('li');
            li.className = "nav-item";

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

                // Zde přiřazujeme události
                $('#deleteAccess').off('click').on('click', function() {
                    accessDelete(access.id_access);
                });
            });

            $(document).ready(function() {
                $('#globalShareAccess').on('click', function() {
                    var shareEmail = $('#globalShareEmail').val();
                    var id_access = $('#globalIdAccess').val();

                    accessShare(id_access, shareEmail);
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
                    <li><a class="dropdown-item" id="userLogout">Sign out</a></li>
                </ul>
            </div>
        `;
            document.getElementById('userLogout').addEventListener('click', userLogout);
        }
    }

    function showResponse(data) {
        var toastElement = document.getElementById('myToast');
        var toastBodyElement = toastElement.querySelector('.toast-body');

        var toast = new bootstrap.Toast(toastElement);

        // Čistíme tělo toastu
        toastBodyElement.innerHTML = '';

        // Pokud je error pole
        if (Array.isArray(data.error)) {
            data.error.forEach(function(err) {
                toastBodyElement.innerHTML += '<p>' + err + '</p>';
            });
        }

        // Pokud je output pole
        if (Array.isArray(data.output)) {
            data.output.forEach(function(out) {
                toastBodyElement.innerHTML += '<p>' + out + '</p>';
            });
        }

        toast.show();
    }


    $(document).on('click', '.go-up', function(e){
        e.preventDefault();

       change('..')
    });

});
