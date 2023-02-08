<?php 
class Lab {
    public function __construct($name, $url, $desc, $active) {
        $this->name = $name;
        $this->url = $url;
        $this->desc = $desc;
        $this->active = $active;
    }
}
function addZeroPadding($num, $length) {
    while (strlen($num) < $length) {
        $num = '0'.$num;
    }
    return $num;
}
$labs = [];
array_push($labs, new Lab('Lab 01', './cv01/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 02', './cv02/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 03', './cv03/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 04', './cv04/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 05', './cv05/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 06', './cv06/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 07', './cv07/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 08', './cv08/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 09', './cv09/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 10', './cv10/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 11', './cv11/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 12', './cv12/', 'I have no idea what I am doing', true));
array_push($labs, new Lab('Lab 13', './cv13/', 'I have no idea what I am doing', true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>4IZ278 Labs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .card-img-top {
            width: 50%;
            margin: auto;
        }
        .card {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header></header>
    <main class="container">
        <h1 class="text-center">My labs</h1>
        <div class="row labs text-center">
            <?php foreach ($labs as $lab): ?>
            <div class="card" style="width: 25%;">
                <img class="card-img-top" src="http://4.bp.blogspot.com/-ljIAvYh4Vkc/TuddQdJVQHI/AAAAAAAABnY/i1oMO4XbNic/s1600/icon_black.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lab->name; ?></h5>
                    <p class="card-text"><?php echo $lab->desc; ?></p>
                    <a class="btn <?php echo $lab->active ? 'btn-primary' : 'btn-secondary'; ?>" href="<?php echo $lab->active ? $lab->url : '#'; ?>"><?php echo $lab->name; ?></a>
                </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>
</html>
