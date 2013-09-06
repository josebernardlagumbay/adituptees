<?php
   if($web_content[0]['web_content_type'] != 'menu link'){
    ?>
            <?php
                if($has_image){
            ?>
                    <div class="row">
                        <div class="span10">
                            <div class="content_header"><?php echo $web_content[0]['web_content_name'] ?></div>
                            <hr />
                            <div class="padding_top20 content_detail fontsize6">
                                <div>
                                    <img class="img-polaroid pull-right margin_left10" src="<?php echo base_url('uploads/web_content/'.$content_image[0]['image_display']) ?>" alt="<?php echo $web_content[0]['web_content_name'] ?>" title="<?php echo $web_content[0]['web_content_name'] ?>"/>
                                    <div class="padding_right10"><?php echo $web_content[0]['full_content'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                } else {
            ?>
                    <div class="row">
                        <div class="span10">
                            <div class="content_header"><?php echo $web_content[0]['web_content_name'] ?></div>
                            <hr />
                            <div class="padding_top20 content_detail fontsize6"><?php echo $web_content[0]['full_content'] ?></div>
                        </div>
                    </div>
            <?php
                }
            ?>                   
    <?php    	         
   } else {
            if($menu_link_content){
                foreach($menu_link_content as $list){
                    if($list['image']){
    ?>
                        <div class="row">
                            <div class="span10">
                                <div class="content_header"><?php echo $list['web_content_name'] ?></div>
                                <hr />
                                <div class="padding_top20 content_detail fontsize6">
                                    <div>
                                        <img class="img-polaroid pull-right margin_left10" src="<?php echo base_url('uploads/web_content/'.$list['image']) ?>" alt="<?php echo $web_content[0]['web_content_name'] ?>" title="<?php echo $web_content[0]['web_content_name'] ?>"/>
                                        <div class="padding_right10"><?php echo $list['full_content'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
    <?php                                
                    } else {
    ?>
                        <div class="row">
                            <div class="span10">
                                <div class="content_header"><?php echo $list['web_content_name'] ?></div>
                                <hr />
                                <div class="padding_top20 content_detail fontsize6"><?php echo $list['full_content'] ?></div>
                            </div>
                        </div>
                        <br />
    <?php                                
                    }
                }
            }    	           
   }
?>
