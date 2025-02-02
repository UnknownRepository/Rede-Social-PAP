<?php 
include_once('./classes/DB.php');

include_once('./classes/cookie_login.php');
include_once('./classes/post.php');
include_once('./classes/image.php');
include_once('./classes/notifyClass.php');
 $user__id = Login::isLoggedIn();
$CurrentUser = "";
$CurrentUser = DB::query('SELECT username from users where id =:id', array(':id'=>$user__id))[0]['username'];
$username = "";
$isFollowing = False;
$followerid =Login::isLoggedIn();
if (Login::IsLoggedIn()) 
{
  $user__id=Login::IsLoggedIn();
  
}
else
{
    die(header("Location: login.php"));
}
if(isset($_GET['u']))
{
    if (DB::query('SELECT username from users where username =:username', array(':username'=>$_GET['u']))) 
    {
            $username = DB::query('SELECT username from users where username =:username', array(':username'=>$_GET['u']))[0]['username'];
            $userid = DB::query('SELECT id from users where username=:username', array(':username'=>$_GET['u']))[0]['id'];
                
            
            if(isset($_POST['Seguir']))
            {
                if ($userid != $followerid) 
                    {                           
            
                if (!DB::query('SELECT follower_id FROM seguidores WHERE user_id=:userid AND follower_id=:followerid',array(':userid' =>$userid,':followerid'=>$followerid))) 
                {
                        DB_update::query_update('INSERT INTO seguidores VALUES (\'\', :userid, :followerid)',array(':userid' =>$userid,':followerid'=>$followerid));
                }
                
             }

            }
            $isFollowing = True;
            if(isset($_POST['unfollow']))
            {
                if ($userid != $followerid) 
                    {
                if (DB::query('SELECT follower_id FROM seguidores WHERE user_id=:userid AND follower_id=:followerid',array(':userid' =>$userid,':followerid'=>$followerid))) 
                {
                        DB_update::query_update('DELETE FROM seguidores WHERE user_id=:userid AND follower_id=:followerid  ',array(':userid' =>$userid,':followerid'=>$followerid));
                }
                
               }
            }
            $isFollowing = False;
            if (DB::query('SELECT follower_id FROM seguidores WHERE user_id=:userid AND follower_id=:followerid  ',array(':userid' =>$userid,':followerid'=>$followerid)))
                {
                        $isFollowing = True;
                }


                if(isset($_POST['deletepost']))
                {
                    if(DB::query('SELECT id FROM posts WHERE id =:postid AND user_id =:userid', array(':postid'=>$_GET['postid'],':userid'=>$followerid)))
                    {
                        DB_update::query_update('DELETE FROM posts WHERE id =:postid AND user_id =:userid',array(':postid'=>$_GET['postid'],':userid'=>$followerid));
                        DB_update::query_update('DELETE FROM post_likes WHERE post_id =:postid',array(':postid'=>$_GET['postid']));
                    }
                }



                if (isset($_POST['post'])) {
                        if ($_FILES['postimg']['size'] == 0) {
                                Post::createPost($_POST['postbody'], Login::isLoggedIn(), $userid);
                        } else {
                                $postid = Post::createIMGPost($_POST['postbody'], Login::isLoggedIn(), $userid);
                                Image::uploadImage('postimg', "UPDATE posts SET postimg=:postimg WHERE id=:postid", array(':postid'=>$postid));
                        }
                }

                if (isset($_GET['postid']) && !isset($_POST['deletepost'])) {
                        post::likePost($_GET['postid'], $followerid);
                }

                $posts = post::displayPosts($userid, $username, $followerid);


        } else {
                die('User not found!');
        }
        
}

?>

<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        .postimg
{
    opacity: 0;
    transition: all 2s ease-out;
    width: 100%;
}
    </style>
    
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search-1.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search-2.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Search-Field-With-Icon.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>
</head>

<body>
    <header>
        <nav class="navbar navbar-light navbar-expand-md shadow" style="border-color: #cbcbcb;">
            <div class="container-fluid"><a class="navbar-brand" href="#" style="background-image: url(&quot;assets/img/índice.png&quot;);"></a>
                <form class="form-inline"> 
                    <div><input class="form-control sbox" type="text" placeholder="Procurar" style="width: 150%;">
                        <ul class="list-group autocomplete" style="position: absolute;z-index: 100;">
                            
                        </ul>
                    </div>
                </form><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1" style="width: 563px;margin-right: 0px;">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active text-left" href="homepage.php" style="font-size: 20px;">Pagina Principal</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="messages.php" style="font-size: 20px;">Mensagens</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notify.php" style="font-size: 20px;">Notificações</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php?u=<?php echo $CurrentUser; ?>" style="font-size: 20px;">Profile</a></li>
                             <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="font-size: 20px;">Utilizador </a>
    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="profile.php?u=<?php echo $CurrentUser; ?>" style="font-size: 20px;">Prefil</a><form action="logout.php" method="POST"><a class="dropdown-item" role="presentation" href="logout.php" style="font-size: 20px;">Sair</a></form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header><br>
     <form action="profile.php?u=<?php echo $username; ?>" method="post">
    <div class="container">
                   
        <h1 style="color: rgb(0,0,0);"><?php echo $username; ?> Profile

            <?php 
            if ($userid != $followerid) {
                if ($isFollowing) {
                        echo '<button class="btn btn-primary" type="submit" name="unfollow"  style="background-color: rgba(227,225,225,0);color: rgb(0,120,41);border-color: #000000;border: 1px solid #cbcbcb;width: 10%;margin-left: 2%;">Unfollow</button>&nbsp; &nbsp;</h1>';
                } else {
                        echo '<button class="btn btn-primary" type="submit" name="Seguir"  style="background-color: rgba(227,225,225,0);color: rgb(0,120,41);border-color: #000000;border: 1px solid #cbcbcb;width: 10%;margin-left: 2%;">Seguir</button>&nbsp; &nbsp;</h1>';
                }
         }
           
        ?>
    
        </form>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-2" style="border-color: #cbcbcb;">
                    <ul class="list-group">
                        <li class="list-group-item" style="color: rgb(0,0,0);width: 100%;">
                            <div class="box" style="width: 100%;"><img class="rounded-circle" src="assets/img/img_avatar.png" style="width: 40px;">
                                <h3 class="name text-break"><?php echo $username; ?></h3>
                                <p class="title">Musico</p>
                                <p class="description">Sou um musico profissional e rico.</p>
                                <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                            </div>
                        </li>
                    </ul>

                    <form action="messages.php#<?php echo $userid?>" method="POST">
                    <button class="btn btn-primary" type="submit" style="/*background: initial;*/background-color: #00000000;border-color: #cbcbcb;border: 1px solid #cbcbcb;"><i class="far fa-envelope"></i>&nbsp;Messagem</button></div>
                    </form>
                <div class="col-xl-6" style="border-color: #000000;background-color: rgba(0,0,0,0);color: rgb(0,0,0);">
                    <ul class="list-group">
                        <div class="timelineposts">
                        
                    
                </div>
                    </ul>
                </div>
                <?php if ($userid == $followerid) {
                   echo "<div class='col-md-6 col-xl-4'>
                   <button class='btn btn-primary' type='button' style='background-color: rgb(7,215,65);'' onclick='showNewPostModal()'>New Post</button>

                </div>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="commentsmodal" role="dialog" tabindex="-1" style="color: rgb(0,0,0); padding: 200px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Comentários</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                             <h3>Não há comentários</h3>   
                                
                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Fechar</button></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="newpost" role="dialog" tabindex="-1" style="color: rgb(0,0,0); padding: 200px; ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">New Post</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div style="max-height: 400px ;overflow-y: auto">
                            <form action="profile.php?u=<?php echo $CurrentUser; ?>" method="post" enctype="multipart/form-data">
                                <textarea name="postbody" rows="5" cols="64" style="width: 100%;"></textarea>
                                <br />Upload an image:
                                <input type="file" name="postimg">
                        </div>
                        <div class="modal-footer">
                                                <input type="submit" name="post" value="Post" class="btn btn-default" type="button" style="background-image:url(&quot;none&quot;);background-color:#2bda05;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">
                                                
                            <button class="btn btn-light" type="button" data-dismiss="modal">Fechar</button></div>
                    </div>
                </div>
            </div>
            <div class="footer-dark" >
        <footer style="position: relative;">
            <div class="container">
                <p class="copyright">Social Media© 2020</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script type="text/javascript">

     var start = 5;
    var working = false;
    $(window).scroll(function() {
            if ($(this).scrollTop() + 1 >= $('body').height() - $(window).height()) {
                    if (working == false) {
                            working = true;
                             
                            $.ajax({

                                    type: "GET",
                                    url: "restapi/profileposts?u=<?php echo $username; ?> &start="+start,
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                     success: function(r) {
                                var posts = JSON.parse(r)
                                $.each(posts, function(index) {

                                    if (posts[index].PostImage == "") 
                                    {



                                        $('.timelineposts').html(
                                                $('.timelineposts').html() +

                                                ' <li class="list-group-item" id="'+posts[index].PostId+'" style="border-color: #cbcbcb;"><blockquote class="blockquote"><p class="mb-0" style="color: rgb(0,0,0);">'+posts[index].PostBody+'</p><footer class="blockquote-footer">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'</footer></blockquote><?php if($username ==$CurrentUser)
{
         $postss = "'+posts[index].PostId+'";
         echo '<button class="btn btn-primary delete" type="button" name="delete" id="'.$postss.'" style="position: absolute;right: 0;top: 0;width: 0px;color: rgba(220,220,220,0.26);background-color: rgba(227,225,225,0.07);height: 23px;"><i class="fa fa-remove" style="position: absolute; width:100% ;right: 0;top: 0;color: rgb(255,0,0);"></i>';

}

    ?></button><button class="btn btn-primary" type="button" data-id="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;">&nbsp;<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+posts[index].Likes+' Likes</button><button      class="btn btn-primary" type="button" data-postid="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;" onclick="showCommentsModal()">&nbsp;<i class="typcn typcn-pencil" data-bs-hover-animate="rubberBand" style="color: rgb(255,0,0);"></i>&nbsp;Comentários</button>  </li>   '
                                              
                                        )
                                         }
                                         else
                                         {
                                            $('.timelineposts').html(
                                                $('.timelineposts').html() +

                                                ' <li class="list-group-item" id="'+posts[index].PostId+'" style="border-color: #cbcbcb;"><blockquote class="blockquote"><p class="mb-0" style="color: rgb(0,0,0);">'+posts[index].PostBody+'</p><img src="" data-tempsrc="'+posts[index].PostImage+'" class="postimg" id ="img'+posts[index].PostId+'"><footer class="blockquote-footer">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'</footer></blockquote><?php if($username ==$CurrentUser)
{
        $postss = "'+posts[index].PostId+'";
         echo '<button class="btn btn-primary delete" type="button" name="delete" id=".$postss." style="position: absolute;right: 0;top: 0;width: 0px;color: rgba(220,220,220,0.26);background-color: rgba(227,225,225,0.07);height: 23px;"><i class="fa fa-remove" style="position: absolute; width:100% ;right: 0;top: 0;color: rgb(255,0,0);"></i>';
}

    ?></button><button class="btn btn-primary" type="button" data-id="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;">&nbsp;<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+posts[index].Likes+' Likes</button><button      class="btn btn-primary" type="button" data-postid="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;" onclick="showCommentsModal()">&nbsp;<i class="typcn typcn-pencil" data-bs-hover-animate="rubberBand" style="color: rgb(255,0,0);"></i>&nbsp;Comentários</button>  </li>   '
                                              
                                        )
                                         }
                                          
                                         
                                         
                                        $('[data-postid]').click(function() {
                                                var buttonid = $(this).attr('data-postid');

                                                $.ajax({

                                                        type: "GET",
                                                        url: "restapi/comments?postid=" + $(this).attr('data-postid'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r) {
                                                                var res = JSON.parse(r)
                                                                showCommentsModal(res);
                                                        },
                                                        error: function(r) {
                                                                console.log(r)
                                                        }

                                                });
                                        });




                                        $('[data-id]').click(function(r) {
                                                var buttonid = $(this).attr('data-id');
                                                $.ajax({

                                                        type: "POST",
                                                        url: "restapi/likes?id=" + $(this).attr('data-id'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r) {
                                                                var res = JSON.parse(r);
                                                                 
                                                                $("[data-id='"+buttonid+"']").html('<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+res.Likes+' Likes</button> ')
                                                                console.log(r);
                                                        },
                                                        error: function(r) {
                                                                console.log(r)
                                                        }

                                                });
                                        })
                                })
                                    
                             $('.postimg').each(function() {
                                        this.src=$(this).attr('data-tempsrc')
                                        this.onload = function() {
                                                this.style.opacity = '1';
                                        }
                                })
                             scrollToAnchor(location.hash)

                                            start+=5;
                                            setTimeout(function() {
                                                    working = false;
                                            }, 4000)

                                    },
                                    error: function(r) {
                                            console.log(r)
                                    }

                            });
                    }
            }
    })
        function scrollToAnchor(aid){
        var aTag = $(aid);
        $('html,body').animate({scrollTop: aTag.offset().top},'slow');
    }

        $(document).ready(function() {
            $('.sbox').keyup(function() {
                        $('.autocomplete').html("")
                        $.ajax({

                                type: "GET",
                                url: "restapi/search?query=" + $(this).val(),
                                processData: false,
                                contentType: "application/json",
                                data: '',
                                success: function(r) {
                                        r = JSON.parse(r)
                                        for (var i = 0; i < r.length; i++) {
                                                console.log(r[i].body)
                                                $('.autocomplete').html(
                                                        $('.autocomplete').html() +
                                                        '<a href="profile.php?u='+r[i].username+'"><li class="list-group-item"><span>'+r[i].body+' Posted by '+r[i].username+'</span></li>'
                                                )
                                        }
                                },
                                error: function(r) {
                                        console.log(r)
                                }
                        })
                })
                $.ajax({

                        type: "GET",
                        url: "restapi/profileposts?u=<?php echo $username; ?>&start= 0",
                        processData: false,
                        contentType: "application/json",
                        data: '',
                        success: function(r) {
                                var posts = JSON.parse(r)
                                $.each(posts, function(index) {

                                    if (posts[index].PostImage == "") 
                                    {



                                        $('.timelineposts').html(
                                                $('.timelineposts').html() +

                                                ' <li class="list-group-item" id="'+posts[index].PostId+'" style="border-color: #cbcbcb;"><blockquote class="blockquote"><p class="mb-0" style="color: rgb(0,0,0);">'+posts[index].PostBody+'</p><footer class="blockquote-footer">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'</footer></blockquote><?php if($username ==$CurrentUser)
{
       $postss = "'+posts[index].PostId+'";
         echo '<button class="btn btn-primary delete" type="button" name="delete" id="'.$postss.'" style="position: absolute;right: 0;top: 0;width: 0px;color: rgba(220,220,220,0.26);background-color: rgba(227,225,225,0.07);height: 23px;"><i class="fa fa-remove" style="position: absolute; width:100% ;right: 0;top: 0;color: rgb(255,0,0);"></i>';

}

    ?></button><button class="btn btn-primary" type="button" data-id="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;">&nbsp;<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+posts[index].Likes+' Likes</button><button      class="btn btn-primary" type="button" data-postid="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;" onclick="showCommentsModal()">&nbsp;<i class="typcn typcn-pencil" data-bs-hover-animate="rubberBand" style="color: rgb(255,0,0);"></i>&nbsp;Comentários</button>  </li> </ul>  '
                                              
                                        )
                                         }
                                         else
                                         {
                                            $('.timelineposts').html(
                                                $('.timelineposts').html() +

                                                ' <li class="list-group-item" id="'+posts[index].PostId+'" style="border-color: #cbcbcb;"><blockquote class="blockquote"><p class="mb-0" style="color: rgb(0,0,0);">'+posts[index].PostBody+'</p><img src="" data-tempsrc="'+posts[index].PostImage+'" class="postimg" id ="img'+posts[index].PostId+'"><footer class="blockquote-footer">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'</footer></blockquote><?php if($username ==$CurrentUser)

{
    $postss = "'+posts[index].PostId+'";
         echo '<button class="btn btn-primary delete" type="button" name="delete" id="'.$postss.'" style="position: absolute;right: 0;top: 0;width: 0px;color: rgba(220,220,220,0.26);background-color: rgba(227,225,225,0.07);height: 23px;"><i class="fa fa-remove" style="position: absolute; width:100% ;right: 0;top: 0;color: rgb(255,0,0);"></i>';
}

    ?></button><button class="btn btn-primary" type="button" data-id="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;">&nbsp;<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+posts[index].Likes+' Likes</button><button      class="btn btn-primary" type="button" data-postid="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;" onclick="showCommentsModal()">&nbsp;<i class="typcn typcn-pencil" data-bs-hover-animate="rubberBand" style="color: rgb(255,0,0);"></i>&nbsp;Comentários</button>  </li> </ul>  '
                                              
                                        )
                                         }
                                         
                                        
                                        $('[data-postid]').click(function() {
                                                var buttonid = $(this).attr('data-postid');

                                                $.ajax({

                                                        type: "GET",
                                                        url: "restapi/comments?postid=" + $(this).attr('data-postid'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r) {
                                                                var res = JSON.parse(r)
                                                                showCommentsModal(res);
                                                        },
                                                        error: function(r) {
                                                                console.log(r)
                                                        }

                                                });
                                        });




                                        $('[data-id]').click(function(r) {
                                                var buttonid = $(this).attr('data-id');
                                                $.ajax({

                                                        type: "POST",
                                                        url: "restapi/likes?id=" + $(this).attr('data-id'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r) {
                                                                var res = JSON.parse(r);
                                                                 
                                                                $("[data-id='"+buttonid+"']").html('<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+res.Likes+' Likes</button> ')
                                                                console.log(r);
                                                        },
                                                        error: function(r) {
                                                                console.log(r)
                                                        }

                                                });
                                        })
                                })
                                    
                             $('.postimg').each(function() {
                                        this.src=$(this).attr('data-tempsrc')
                                        this.onload = function() {
                                                this.style.opacity = '1';
                                        }
                                })
                             scrollToAnchor(location.hash)
                        },
                        error: function(r) {
                                console.log(r)
                        }

                });

        });

  function showNewPostModal()
  {
    $('#newpost').modal('show')

  }
  $(document).on('click', '.delete', function(){
     var id = $(this).attr('id');
                                
$.ajax({
url:"restapi/DeletePost?id=" + $(this).attr('id'),
method:"DELETE",
data:{id:id},
 success:function(data)
{
    window.location = 'profile.php?u=<?php echo $username ?>'
    console.log(data)
   }
  })
                                         
  });

  function showCommentsModal(res) {
                $('#commentsmodal').modal('show')
                var output = "";
                for (var i = 0; i < res.length; i++) {
                        output += res[i].Comment;
                        output += " ~ Comment by  ";
                        output += res[i].CommentedBy;
                        output += "<hr />";
                }

                $('.modal-body').html(output)
        }
    
    </script>
</body>

</html>