<!DOCTYPE html>
<html lang="en">

<body itemscope>
    <main>
        <section>
            <div class="block">
                <div class="fixed-bg" style="background-image: url(assets/images/topbg.jpg);"></div>
                <div class="page-title-wrapper text-center">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <div class="page-title-inner">
                            <h1 itemprop="headline">Blog Detail With No Sidebar</h1>
                                <span>A Greate Restaurant Website</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php 

        if(!empty($blog_detail)){
        foreach($blog_detail as $data){
        
        $id                     = $data['id'];
        $title                  = $data['title'];
        $sub_title              = $data['sub_title'];
        $image                  = $data['image'];
        $timestamp              = $data['updated'];
        $description            = $data['description'];
        $status                 = $data['status'];
        $category               = $data['name'];
        $tags                   = $data['tags'];

        $timezone = 'UTC'; 
        $datetime = new DateTime($timestamp, new DateTimeZone($timezone));
        $date = $datetime->format('d F');

        if(!empty($image) && file_exists( $this->config->item('blog_image_base_path').$data['image'])){
              $image = $data['image']; 
       }
        else{
            $res_image = base_url('assets/images/resource/most-popular-img1.png');
        }
     
    ?>
        <div class="bread-crumbs-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>" title="" itemprop="url">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('blog');?>" title="" itemprop="url">Blog</a></li>
                    <li class="breadcrumb-item active"><?= $title;?></li>
                </ol>
            </div>
        </div>

        <section>
            
            <div class="block less-spacing gray-bg">
                <div class="sec-box bottom-padd140">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        <div class="blog-detail-wrapper">
                                            <div class="blog-detail-thumb wow fadeIn" data-wow-delay="0.2s">
                                                <img src="<?php echo $this->config->item('blog_image').$image?>" alt="blog-detial-img2-1.jpg" itemprop="image">

                                                <!-- <a class="brd-rd2" href="#" title="" itemprop="url"><img src="<?php echo $this->config->item('blog_image').$image?>" alt="news-img1.jpg" height="223" width="364" itemprop="image"></a> -->
                                            </div>
                                            <div class="blog-detail-info">
                                                <span class="post-detail-date red-clr"><i class="fa fa-clock-o"></i><?php echo $date; ?></span>
                                                <div class="post-meta">
                                                    <span><i class="fa fa-eye red-clr"></i> 95 Views</span>
                                                    <span><i class="fa fa-comment-o red-clr"></i> 5 Comments</span>
                                                </div>
                                            </div>
                                            <h1 itemprop="headline"><?php echo $title; ?></h1><br>
                                            <p itemprop="description"><?php echo $description; ?></p> 
                                             <!-- <a class="alignnone wow fadeIn" data-wow-delay="0.2s" href="assets/images/resource/blog-detial-img2-3.jpg" data-fancybox="gallery" title="" itemprop="url"><img src="assets/images/resource/blog-detial-img2-3.jpg" alt="blog-detial-img2-3.jpg" itemprop="image"></a> --> 
                                            <div class="post-tags red-clr">
                                                <span>Tags:</span>
                                                <a href="#" title="" itemprop="url"><?= $tags; ?></a>
                                            </div>
                                            <div class="post-cate red-clr">
                                                <span>Category:</span>
                                                <a href="#" title="<?= $category; ?>" itemprop="url"><?= $category; ?></a>
                                            </div>
                                           <!--  <div class="post-share">
                                                <span>Share:</span>
                                                <a class="brd-rd2" href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i></a>
                                                <a class="brd-rd2" href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                                                <a class="brd-rd2" href="#" title="Pinterest" itemprop="url" target="_blank"><i class="fa fa-pinterest"></i></a>
                                                <a class="brd-rd2" href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                <a class="brd-rd2" href="#" title="Linkedin" itemprop="url" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                <a class="brd-rd2" href="#" title="Vimeo" itemprop="url" target="_blank"><i class="fa fa-vimeo"></i></a>
                                            </div> -->
                                            <!-- <div class="post-next-prev">
                                                <a class="prev-post" href="#" title="Previous Post" itemprop="url"><i class="fa fa-angle-left"></i> PREV</a> -
                                                <a class="next-post" href="#" title="Next Post" itemprop="url">NEXT <i class="fa fa-angle-right"></i></a>
                                            </div> -->
                                        </div>
                                       
                                        <div class="comments-wrapper">
                                            <h3 class="title4" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Comm</span>ents</h3>
                                            <ul class="comments-thread">
                                                <?php if(!empty($review_data)) { 
                                                foreach ($review_data as $data) {
                                                  ?>
                                                <li>
                                                    <div class="comment">
                                                        <img class="brd-rd50" src="<?php echo base_url('uploads/customer_profiles/'.$data['profile']); ?>" alt="comment1.jpg">
                                                        <div class="comment-info">
                                                            <h4 itemprop="headline"><a href="#" title="" itemprop="url"><?=!empty($data['name']) ? $data['name'] : ''; ?></a></h4>
                                                            <i><?=!empty($data['created_date']) ? $data['created_date'] : ''; ?> / <a class="comment-reply-link red-clr" href="#" title="" itemprop="url">Reply</a></i>
                                                            <p itemprop="description"><?=!empty($data['message']) ? $data['message'] : ''; ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php } } ?>
                                            </ul>
                                        </div>
                                    <?php if($status == 1){ ?>
                                        <div class="leav-comment-wrapper">
                                            <h3 class="title4" itemprop="headline"><span class="sudo-bottom sudo-bg-red">Leave</span> a Reply</h3>
                                            <form class="reply-form" id="form" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-6 col-lg-12">
                                                        <input class="brd-rd2" type="text" id="name" name="name" placeholder="Your Name">
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-lg-12">
                                                        <input class="brd-rd2" type="email" id="email" name="email" placeholder="Your Email">
                                                    </div>

                                                    <div class="col-md-4 col-sm-12 col-lg-12">
                                                        <input class="brd-rd2" type="text" id="subject" name="subject" placeholder="Subject">
                                                    </div>

                                                    <div class="col-md-4 col-sm-12 col-lg-12">
                                                        <input class="brd-rd2" type="hidden" id="blog_id" name="blog_id" value="<?= !empty($id) ? $id : '' ;?>">
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <textarea class="brd-rd2" name="msg" id="msg" placeholder="Message"></textarea>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                                        <button class="brd-rd3 red-bg" id="send_msg" type="submit">SEND MESSAGE</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
 
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Section Box -->
            </div>
        </section>
        <?php }} ?>

    </main><!-- Main Wrapper -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">

    $(document).ready(function(e){

        $("#form").on('submit', function(e){
            e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>blog/review_form",
                    data: new FormData(this),
                    enctype: 'multipart/form-data',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success : function(data)
                    {
                       alert(data);
                       document.getElementById("form").reset();
                    },
                    error : function(){
                        console.log("Something went to wrong");
                    }
                });
            return false;
        });
    });

</script>

</body>	
</html>