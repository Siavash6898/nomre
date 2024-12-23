<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../bs/css/bootstrap.rtl.css">
    <style>
        .h1080{
            min-height: 4080px;

        }
        .h250{
            min-height: 2080px;
        }
        .h400{
            height: auto;
        }
        table td, table th{
            text-align: center;
        }

    </style>


    <?php
//connect to db for test
        $link = mysqli_connect("localhost" ,'root', '', "digivala");
        if(isset($_POST['name']) && $_POST['name']!=''){

            $name = $_POST['name'];
            $meli = $_POST['codemeli'];
            $dars = $_POST['dars'];
            $nomre = $_POST['nomre'];
            
            $query = "INSERT INTO student (name, codemeli, dars, nomre) VALUES ('$name', '$meli', '$dars', '$nomre')";

            //echo $query;
            $res = mysqli_query($link, $query);
        }

    ?>

</head>
<body dir="rtl">
<div class="container-fluid h1080 bg-primary pt-5">
    <div class="container h400 ">
        <div class="row">
            <div class="col-4 offset-4 h400 bg-dark-subtle rounded-3 shadow-sm p-4">
                <form class="form-group" action="formnomre.php" method="post">
                    <div class="row">
                        <div class="col">
                            <input type="text" placeholder="نام دانش آموز" name="name" class="form-control py-1  my-1">
                        </div>
                        <div class="col">
                            <input type="text" placeholder="کدملی"  name="codemeli" class="form-control py-1  my-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <input type="text" placeholder="درس" name="dars" class="form-control py-1 my-1">
                        </div>
                        <div class="col-4">
                            <input type="number" placeholder="نمره" name="nomre"  class="form-control py-1  my-1">
                        </div>
                    </div>

                     <input type="submit" value="ثبت نمره" class="btn btn-success form-control mt-2 p-2 w-25 float-end">
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-4 offset-4 h400 bg-dark-subtle rounded-3 shadow-sm p-4 mt-3">
               <div class="row">
                   <form class="form-group" action="formnomre.php" method="post">
                       <div class="row">
                           <div class="col-9">
                               <input type="text" placeholder="کدملی" name="searchmeli" class="form-control py-1  my-1">
                           </div>
                           <div class="col-2">
                               <input type="submit"  value="جستجو" type="submit" class="btn btn-success">
                           </div>
                       </div>
                   </form>
                </div>
               <!-- <select class="form-select">
                    <option class="form-select">Ali</option>
                    <option>Reza</option>

                </select>!-->
                <?php
                    if(isset($_POST['searchmeli']) && $_POST['searchmeli']!==''){

                        $query = "Select * from student where codemeli=".$_POST['searchmeli'];
                        //echo $query;
                        $result = mysqli_query($link, $query);

                        $queryavg = "SELECT AVG(`nomre`) FROM `student` WHERE codemeli=".$_POST['searchmeli'];
                        $res = mysqli_query($link, $queryavg);

                        $avg=mysqli_fetch_array($res);
                        //var_dump($avg);
                        //echo $avg[0];

                    }else{

                         $query = "Select * from student";
                         $result = mysqli_query($link, $query);
                    }




                ?>
                <table class="table table-striped table-warning rounded-3 table-hover table-bordered">
                    <tr><th>نام</th><th>codemeli</th><th >نام درس</th><th>نمره</th></tr>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>
                                    <td>".$row['name']."</td>
                                    <td>".$row['codemeli']."</td>
                                     <td>".$row['dars']."</td>
                                     <td>".$row['nomre']."</td>
                                    </tr>";
                        }

                    ?>


                    <tr class="table-dark table-bordered"><td colspan="3">معدل</td><td>
                           <?php
                           if(isset($avg[0]) && $avg[0]!==""){
                               echo intval($avg[0]);
                           }else{
                               echo 0;
                           }
                                   ?>
                        </td></tr>

                </table>
            </div>

        </div>

    </div>

</div>

</body>
</html>
