<link href="CSS/style_1.css" rel="stylesheet" type="text/css"/>

<!-- Cabezera de contenido 
<div class="container-fluid pt-2">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Destacados</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider2">
            <div class="item px-2">
                <div class="fh5co_hover_news_img">
                    <div class="fh5co_news_img"><img src="Media/termas.jpg" alt=""/></div>
                    <div>
                        <a href="single.html" class="d-block fh5co_small_post_heading"><span class="">Las termas se encuentran habilitadas</span></a>
                        <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                    </div>
                </div>
            </div>
            <div class="item px-2">
                <div class="fh5co_hover_news_img">
                    <div class="fh5co_news_img"><img src="Media/perro.jpg" alt=""/></div>
                    <div>
                        <a href="single.html" class="d-block fh5co_small_post_heading"><span class="">Vacunación contra leishmaniasis</span></a>
                        <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                    </div>
                </div>
            </div>
            <div class="item px-2">
                <div class="fh5co_hover_news_img">
                    <div class="fh5co_news_img"><img src="Media/INVICO.jpg" alt=""/></div>
                    <div>
                        <a href="single.html" class="d-block fh5co_small_post_heading"><span class="">INVICO: Entrega de viviendas</span></a>
                        <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                    </div>
                </div>
            </div>
            <div class="item px-2">
                <div class="fh5co_hover_news_img">
                    <div class="fh5co_news_img"><img src="Media/seth-doyle-133175.jpg" alt=""/></div>
                    <div>
                        <a href="single.html" class="d-block fh5co_small_post_heading"><span class="">The top 10 best computer speakers in the market</span></a>
                        <div class="c_g"><i class="fa fa-clock-o"></i> Oct 16,2017</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="container-fluid pb-4 padding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Noticias</div>
                </div>
				<?php 
                    $date = date('Y-m-d h:i:s', time());
                    $fechaactual = strtotime($date);

					$Blog = obtenerBlog($mysqli);
                    
					foreach($Blog as $ID) {
                        
                        $fechapublicacion  = strtotime($ID[2]) ;

                        if ($fechapublicacion < $fechaactual){

                                $HTML = file_get_contents('Publicaciones/HTML/'.$ID[0].'.html');

                                echo '<div class="row pb-4">'.
                                    '<div class="col-md-5">'.
                                        '<div class="fh5co_hover_news_img">'.
                                            '<div class="fh5co_news_img"><img src="Publicaciones/Preview/'.$ID[0].'.jpeg" alt=""/></div>'.
                                            '<div></div>'.
                                        '</div>'.
                                    '</div>'.
                                    '<div class="col-md-7 animate-box">'.
                                        '<a href="?Seccion=VerPublicacion&Publicacion='.$ID[0].'" class="fh5co_magna py-2">'.$ID[1].'</a> <a href="?Seccion=VerPublicacion&Publicacion='.$ID[0].'" class="fh5co_mini_time py-3">'.$ID[2].'</a>
                                        <div class="fh5co_consectetur">
                                            '.substr(strip_tags($HTML, '<br>'), 0, 256).'...
                                        </div>
                                    </div>
                                </div>';
                            }else{
                            
                             }
					}
				?>
            </div>
        </div>
        <!-- <div class="row mx-0 animate-box" data-animate-effect="fadeInUp">
            <div class="col-12 text-center pb-4 pt-4">
                <a href="#" class="btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Anterior</a>
                <a href="#" class="btn_pagging">1</a>
                <a href="#" class="btn_pagging">2</a>
                <a href="#" class="btn_pagging">3</a>
                <a href="#" class="btn_pagging">...</a>
                <a href="#" class="btn_mange_pagging">Siguiente <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
             </div>
        </div> -->
    </div>
</div>

<script src="Scripts/main.js"></script>