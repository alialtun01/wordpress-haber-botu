<?php
include '../../../wp-load.php';
include '../../../wp-admin/includes/post.php';
include_once 'simple_html_dom.php';

if(get_option("siyaset_kat") != "0")
    include 'siyaset.php';
if(get_option("guncel_kat") != "0")
    include 'guncel.php';
if(get_option("spor_kat") != "0")
    include 'spor.php';
