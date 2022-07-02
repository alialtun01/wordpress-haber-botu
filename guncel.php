<?php
$baglan = file_get_html("https://www.adanahabermerkezi.com/guncel");
$say = 0;
foreach($baglan->find(".swiper-slide .thumbnail .overlay .table .table-cell a") as $element){
    if($say == 1) break;
    
    $haber_detay = file_get_html($element->href);

    $haber_baslik = $haber_detay->find(".panel-heading .panel-title h1")[0]->plaintext;

    if(post_exists($haber_baslik)){
        echo $haber_baslik." isimlik haber zaten var<br>";
        continue;
    }

    $haber_kisa_baslik = $haber_detay->find(".panel-heading .panel-title p")[0]->plaintext;
    $haber_icerik = $haber_detay->find("#detay-metin ")[0]->plaintext;
    $one_cikan_gorsel_link = $haber_detay->find(".panel-body img")[0]->src;

    $my_post = array();

    $my_post['post_title'] = $haber_baslik;
    $my_post['post_content'] = $haber_icerik;
    $my_post['post_status'] = "publish";
    $my_post['post_author'] = 1;
    $my_post['post_excerpt'] = $haber_kisa_baslik;
    $my_post['post_category'] = array(get_option('guncel_kat'));

    $post_id = wp_insert_post($my_post);


    $image_name = md5($haber_baslik).".jpg";
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($one_cikan_gorsel_link);
    $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
    $file_name = basename($unique_file_name);

    if(wp_mkdir_p( $upload_dir['path'] )){
        $file = $upload_dir['path'].'/'.$file_name;
    }else{
        $file = $upload_dir['basedir'].'/'.$file_name; 
    }

    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype( $file_name, null );

    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($file_name),
        'post_content' => '',
        'post_status' => 'inherit',
    );

    $attach_id = wp_insert_attachment($attachment,$file);

    require_once(ABSPATH. 'wp-admin/includes/image.php');

    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

    wp_update_attachment_metadata( $attach_id, $attach_data );

    set_post_thumbnail( $post_id, $attach_id );

    echo $haber_baslik." isimli haber başarıyla eklendi";
    $say++;

}