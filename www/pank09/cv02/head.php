<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
		* {
			box-sizing: border-box;
			margin: 0;
		}
        .bc-list {
            display: flex;
            flex-direction: column;
            max-width: 450px;
        }
		.bc {
            margin-bottom: 20px;

			display: inline-block;
			padding: 25px;
			border-radius: 4px;
			border: 1px solid rgba(0, 0, 0, 0.1);
			background-image: url("https://www.tilingtextures.com/wp-content/uploads/2019/05/0090b-768x768.jpg");
			background-position: center center;
			background-size: cover;
		}

		.bc__header {
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.bc__header .logo {
			height: 30px;
		}

		.bc__header .logo img {
			height: 100%;
		}

		.bc__body {
			margin: 40px 70px 40px;
			text-align: center;
		}

		.bc__body h2 {
			font-size: 20px;
			font-weight: 300;
			margin-bottom: 10px;
		}

		.bc__body h4 {
			font-weight: 300;
		}

		.bc__footer {
			text-align: center;
		}
	</style>
</head>
<body>