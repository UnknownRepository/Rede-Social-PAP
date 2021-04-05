<?php
include('./classes/DB.php');
include_once('./classes/cookie_login.php');
include('./classes/Post.php');
include('./classes/Comment.php');
include_once('./classes/notifyClass.php');
 $userid = Login::isLoggedIn();
$username = "";
$username = DB::query('SELECT username from users where id =:id', array(':id'=>$userid))[0]['username'];
//print_r($username) ;
if (Login::IsLoggedIn()) 
{
  $userid=Login::IsLoggedIn();
  
}
else
{
    die(header("Location: login.php"));
}
?>
<!DOCTYPE html>
<html>
<style type="text/css">
        .postimg
{
    opacity: 0;
    transition: all 2s ease-out;
    width: 100%;
}
    </style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
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
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-light navbar-expand-md shadow" style="border-color: #cbcbcb;">
            <div class="container-fluid"><a class="navbar-brand" href="#" style="background-image: url(&quot;assets/img/índice.png&quot;);"></a>
                <form class="form-inline" style="/*float: none;*//*position: relative;*//*top: 50%;*//*left: 50%;*//transform: translate(-50%, -50%);*position: relative;">
    <div><input type="text" class="form-control sbox" placeholder="Procurar" style="width: 100%;" />
                        <ul class="list-group autocomplete" style="position: absolute;z-index: 100;">
                            
                        </ul>
                    </div>
                </form>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <h1 style="color: rgb(0,0,0); position: absolute; left: 40%;">Timeline</h1>
                <div class="collapse navbar-collapse" id="navcol-1" style="width: 563px;margin-right: 0px;">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active text-left" href="homepage.php" style="font-size: 20px;">Pagina Principal</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="messages.php" style="font-size: 20px;">Mensagens</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="notify.php" style="font-size: 20px;">Notificações</a></li>
                           <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="font-size: 20px;">Utilizador</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="profile.php?u=<?php echo $username; ?>">Profile</a><a class="dropdown-item" role="presentation" href="logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header><br>
    </br>
    </br>
    </br>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6" style="/*border-color: #000000;*//*background-color: rgba(0,0,0,0);*//*color: rgb(0,0,0);*//*float: none;*//*position: relative;*//*top: 30%;*//*left: 50%;*//*transform: translate(-50%, -50%);*/">
                    <ul class="list-group">
                        <div class="timelineposts">
                            
                        </div>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item" style="width: 100%;height: 160px;">
                            <div class="box" style="color: rgb(0,0,0);width: 100%;"><img src="assets/img/sins.png" style="width: 8%;height: 40px;"><button class="btn btn-primary text-center" type="button" style="width: 20%;position: relative;left: 10%;background-color: rgba(241,239,239,0.66);height: 23px;font-size: 15px;/*font: center;*/padding: 0px;">Seguir</button>
                                <h3
                                    class="name" style="width: 100%;font-size: 19px;">johnny Pecados</h3>
                                    <p class="title" style="font-size: 13px;">Ator profissional</p>
                                    <p class="description">Sou atronauta, Cientista, Professor, mas mais importante o teu héroi...</p>
                            </div>
                        </li>
                        
                        <li class="list-group-item" style="width: 100%;height: 160px;">
                            <div class="box" style="color: rgb(0,0,0);width: 100%;"><img src="assets/img/graves.jpg" style="width: 8%;height: 40px;"><button class="btn btn-primary text-center" type="button" style="width: 20%;position: relative;left: 10%;background-color: rgba(241,239,239,0.66);height: 23px;font-size: 15px;/*font: center;*/padding: 0px;">Seguir</button>
                                <h3
                                    class="name" style="width: 100%;font-size: 19px;">Pedro Pereira</h3>
                                    <p class="title" style="font-size: 13px;">Rank 1 EUW Jungler 1000AP oneshot?!?!</p>
                                    <p class="description">Morreu?! Explodi a lua com o meu super laser?!<br></p>
                            </div>
                        </li>
                        <li class="list-group-item" style="width: 100%;height: 160px;">
                            <div class="box" style="color: rgb(0,0,0);width: 100%;"><img src="assets/img/tiagovksi.jpg" style="width: 8%;height: 40px;"><button class="btn btn-primary text-center" type="button" style="width: 20%;position: relative;left: 10%;background-color: rgba(241,239,239,0.66);height: 23px;font-size: 15px;/*font: center;*/padding: 0px;">Seguir</button>
                                <h3
                                    class="name" style="width: 100%;font-size: 19px;">Tiagovskinovovizifiadfhndsif</h3>
                                    <p class="title" style="font-size: 13px;">Youtuber de sucesso</p>
                                    <p class="description">Faço videos! Amo-te Miss Mush-.... Jéssica!&nbsp;<br></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="commentsmodal" role="dialog" tabindex="-1" style="color: rgb(0,0,0); padding: 200px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Comments</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                        <div class="modal-body">
                             <h3>No Comments</h3>   
                                
        
        




                        </div>
                        <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Fechar</button></div>
                    </div>
                </div>
            </div>
        
        <div class="footer-dark" style="position: relative;" >
        <footer >
            <div class="container">
                <p class="copyright">Social Media© 2020</p>
            </div>
        </footer>
    </div>
   
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script type="text/javascript">

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
                                                        '<a href="profile.php?u='+r[i].username+'#'+r[i].id+'"><li class="list-group-item"><span>'+r[i].body+'</span></li></a>'
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
                        url: "restapi/posts",
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

                                                ' <li class="list-group-item" id="'+posts[index].PostId+'" style="border-color: #cbcbcb;"><blockquote class="blockquote"><p class="mb-0" style="color: rgb(0,0,0);">'+posts[index].PostBody+'</p><footer class="blockquote-footer">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'</footer></blockquote></button><button class="btn btn-primary" type="button" data-id="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;">&nbsp;<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+posts[index].Likes+' Likes</button><button      class="btn btn-primary" type="button" data-postid="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;" onclick="showCommentsModal()">&nbsp;<i class="typcn typcn-pencil" data-bs-hover-animate="rubberBand" style="color: rgb(255,0,0);"></i>&nbsp;Comentários</button>  </li> </br></br>  '
                                              
                                        )
                                         }
                                         else
                                         {
                                            $('.timelineposts').html(
                                                $('.timelineposts').html() +

                                                ' <li class="list-group-item" id="'+posts[index].PostId+'" style="border-color: #cbcbcb;"><blockquote class="blockquote"><p class="mb-0" style="color: rgb(0,0,0);">'+posts[index].PostBody+'</p><img src="" data-tempsrc="'+posts[index].PostImage+'" class="postimg" id ="img'+posts[index].PostId+'"><footer class="blockquote-footer">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'</footer></blockquote></button><button class="btn btn-primary" type="button" data-id="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;">&nbsp;<i class="icon-fire" data-bs-hover-animate="rubberBand" style="color: rgb(36,0,255);"></i>&nbsp;'+posts[index].Likes+' Likes</button><button      class="btn btn-primary" type="button" data-postid="'+posts[index].PostId+'" style="background-color: rgba(0,0,0,0);color: rgb(0,0,0);width: 142px;font-family: Alegreya, serif;" onclick="showCommentsModal()">&nbsp;<i class="typcn typcn-pencil" data-bs-hover-animate="rubberBand" style="color: rgb(255,0,0);"></i>&nbsp;Comentários</button>  </li> </br></br>  '
                                              
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

                        },
                        error: function(r) {
                                console.log(r)
                        }

                });

        });

        function showCommentsModal(res) {

                $('.modal').modal('show')
                var output = "";
                for (var i = 0; i < res.length; i++) {
                        output += res[i].Comment;
                        output += " ~ ";
                        output += res[i].CommentedBy;
                        output += "<hr />";
                }

                $('.modal-body').html(output)
        }

    </script>
</body>

</html>
