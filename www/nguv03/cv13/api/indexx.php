<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>

    <h1>JSON example</h1>
    <ul id="users"></ul>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.get('./example.php').then((resp) => {
            console.log(resp.data);
            resp.data.forEach((user) => {
                const userElement = document.createElement('li');
                userElement.innerText = user.name;
                document.querySelector('#users').appendChild(userElement);
            })
        });
    </script>
</body>

</html>