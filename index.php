<?php
session_start();
include "dbconnect.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysql_error());
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];
             print'
                <script type="text/javascript">alert("Đăng nhập thành công!!!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript">alert("Sai tên đăng nhập hoặc mật khẩu!!");</script>
                  ';
        }
  }
  else if($_POST['submit']=="register")
  {
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysql_error);
        if(mysqli_num_rows($result)>0)
        {   
               print'
               <script type="text/javascript">alert("tên đăng nhập đã tồn tại");</script>
                    ';

        }
        else
        {
          $query ="INSERT INTO users VALUES ('$username','$password')";
          $result=mysqli_query($con,$query);
          print'
                <script type="text/javascript">
                 alert("Đăng ký thành công!!!");
                </script>
               ';
        }
  }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <link rel="icon" type="image/x-icon" href="./img/site.png">
    <title>Cửa hàng sách online</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
      .modal-header {background:#4f008c;color:#fff;font-weight:800;}
      .modal-body{font-weight:800;}
      .modal-body ul{list-style:none;}
      .modal .btn {background:#4f008c;color:#fff;}
      .modal a{color:#D67B22;}
      .modal-backdrop {position:inherit !important;}
       #login_button,#register_button{background:none;color:#D67B22!important;}       
       #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#4f008c;color:#fff;border-color:#f05f40;border-radius:2px;}
  	@media(max-width:767px){
        #query_button {padding: 5px 20px;}
  	}
    </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img class="img-responsive" alt="Brand" src="img/logo.jpg"  style="width: 160px;margin-top: -7px;margin-left: -10px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right">
        <?php
        if(!isset($_SESSION['user']))
          {
            echo'
            <li>
                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Đăng nhập</button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Đăng nhập</h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                              <div class="form-group">
                                                  <label class="sr-only" for="username">Tên đăng nhập</label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password">Mật khẩu</label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
                                                      Đăng nhập
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Đăng ký</button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center">Đăng ký thành viên</h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="username">Tên đăng nhập</label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Mật khẩu</label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block">
                                                    Đăng ký
                                                </button>
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                          </div>
                      </div>
                  </div>
                </div>
            </li>';
          } 
        else
          {   echo' <li> <a href="#" class="btn btn-lg"> Hello ' .$_SESSION['user']. '.</a></li>
                    <li> <a href="cart.php" class="btn btn-lg"> Giỏ hàng </a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg"> Đăng xuất </a> </li>';
               
          }
?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <div id="top" >
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Tìm kiếm bằng tên sách, Tác giả hoặc Danh mục">
              </form>
          </div>
      </div>

      <div class="container-fluid" id="header">
          <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                  <div style="background:#008017;color:#fff;font-weight:800;border:none;padding:15px;"> Cửa hàng sách </div>
                  <ul>
                      <li> <a href="Product.php?value=Business%20and%20Management"> Quản lý kinh doanh </a> </li>
                      <li> <a href="Product.php?value=entrance%20exam"> Thi tuyển sinh </a> </li>
                      <li> <a href="Product.php?value=Literature%20and%20Fiction"> Văn học </a> </li>
                      <li> <a href="Product.php?value=Children%20and%20Teens"> Trẻ em & Thanh thiếu niên </a> </li>
                      <li> <a href="Product.php?value=Regional%20Books"> Sách ngôn ngữ </a> </li>
                      <li> <a href="Product.php?value=Health%20and%20Cooking"> Sức khỏe & Nấu ăn </a> </li>

                  </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          <li data-target="#myCarousel" data-slide-to="4"></li>
                          <li data-target="#myCarousel" data-slide-to="5"></li>
                      </ol>
                      
                        <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img class="img-responsive" src="img/carousel/1.png">
                          </div>

                          <div class="item">
                            <img class="img-responsive "src="img/carousel/2.png">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/3.png">
                          </div>

                          <div class="item">
                            <img class="img-responsive"src="img/carousel/4.png">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/6.png">
                          </div>
                          <div class="item">
                            <img class="img-responsive" src="img/carousel/5.png">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 col-lg-3" id="offer">
                  <a href="Product.php?value=Regional%20Books">              <img class="img-responsive center-block" src="img/offers/01.png"></a>
                  <a href="Product.php?value=Business%20and%20Management">        <img class="img-responsive center-block" src="img/offers/02.png"></a>
                  <a href="Product.php?value=entrance%20exam"> <img class="img-responsive center-block" src="img/offers/03.png"></a>
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid text-center" id="new">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW0001&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/new/0001.jpg">
                  <hr>
                  Nhật ký covid <br>
                  Rs 110  &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 175 </span>
                  <span class="label label-warning">36%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW0002&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/0002.jpg">
                  <hr>
                  Tương lai sau đại dịch covid 19  <br>
                  Rs 68 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 120 </span>
                  <span class="label label-warning">43%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW0003&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/0003.jpg">
                  <hr>
                  Thuật Quyết Định - Suy nghĩ thông minh, làm việc sáng suốt <br>
                  Rs 199 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 259 </span>
                  <span class="label label-warning">33%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW0004&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/0004.jpg">
                  <hr>
                  Kế hoạch quản lý tài chính cá nhân <br>
                  Rs 289 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 435 </span>
                  <span class="label label-warning">33%</span>
              </div>
            </a>
          </div>
      </div>
  </div>

  <div class="container-fluid" id="author">
      <h3 style="color:#D67B22;"> Những tác giả phổ biến </h3>
      <div class="row">
          <div class="col-sm-5 col-md-3 col-lg-3">
              <a href="Author.php?value=Durjoy%20Datta"><img class="img-responsive center-block" src="img/popular-author/0001.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Chetan%20Bhagat"><img class="img-responsive center-block" src="img/popular-author/0002.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Dan%20Brown"><img class="img-responsive center-block" src="img/popular-author/0003.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Ravinder%20Singh"><img class="img-responsive center-block" src="img/popular-author/0004.jpg"></a>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-5 col-md-3 col-lg-3">
              <a href="Author.php?value=Jeffrey%20Archer"><img class="img-responsive center-block" src="img/popular-author/0005.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Salman%20Rushdie"><img class="img-responsive center-block" src="img/popular-author/0006.jpg"><a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=J%20K%20Rowling"><img class="img-responsive center-block" src="img/popular-author/0007.jpg"></a>
          </div>
      </div>
  </div>

  <footer style="margin-left:-6%;margin-right:-6%;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-1 col-md-1 col-lg-1">
              </div>
              <div class="col-sm-7 col-md-5 col-lg-5">
                  <div class="row text-center">
                      <h2>Hãy liên lạc với chúng tôi</h2>
                      <hr class="primary">
                      <p>Bạn vẫn còn những đắn đo? Hãy gọi cho chúng tôi hoặc gửi email cho chúng tôi và chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể!</p>
                  </div>
                  <div class="row">
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-earphone"></span>
                          <p>0842 884 883</p>
                      </div>
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-envelope"></span>
                          <p>nez5cloud@gmail.com</p>
                      </div>
                  </div>
              </div>
              <div class="hidden-sm-down col-md-2 col-lg-2">
              </div>
              <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                  <h2 style="color:#D67B22;">Theo dõi chúng tôi tại</h2>
                  <div>
                      <a href="https://twitter.com/Erorr_0000">
                      <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="35" height="35" />
                      </a>
                      <a href="https://www.facebook.com/levanduc06052001">
                      <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </footer>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" id="query_button" class="btn btn-lg" data-toggle="modal" data-target="#query">Đặt câu hỏi</button>
  <!-- Modal -->
  <div class="modal fade" id="query" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Đặt câu hỏi của bạn ở đây!</h4>
          </div>
          <div class="modal-body">           
                    <form method="post" action="query.php" class="form" role="form">
                        <div class="form-group">
                             <label class="sr-only" for="name">Name</label>
                             <input type="text" class="form-control"  placeholder="Tên của bạn" name="sender" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="email">Email</label>
                             <input type="email" class="form-control" placeholder="Email của bạn" name="senderEmail" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="query">Câu hỏi</label>
                             <textarea class="form-control" rows="5" cols="30" name="Câu hỏi của bạn..." placeholder="Câu hỏi của bạn..." required></textarea>
                        </div>
                        <div class="form-group">
                              <button type="submit" name="submit" value="query" class="btn btn-block">
                                                              Gửi câu hỏi
                               </button>
                        </div>
                    </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          </div>
      </div>
    </div>  
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	