<?php 
$kategoriler = get_categories(array("hide_empty" => false));
if(isset($_POST['kaydetbtn'])){
    update_option("siyaset_kat",$_POST['siyaset']);
    update_option("guncel_kat",$_POST['guncel']);
    update_option("spor_kat",$_POST['spor']);
}
?>
<h1>Bot Ayarları</h1>
<form action="" method="POST">
    <div class="form-group">
        <label for="siyaset">Siyaset Kategorisini Seçin</label>
        <select id="siyaset" class="form-control" name="siyaset">
            <option value="0">Bu kategoriyi Çekme</option>
            <?php 
            $siyaset_kategori = get_option("siyaset_kat");
            foreach ($kategoriler as $kategori) {
                if($kategori->term_id ==  $siyaset_kategori){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                echo "<option $selected value='$kategori->term_id'>$kategori->name</option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="guncel">Güncel Kategorisini Seçin</label>
        <select id="guncel" class="form-control" name="guncel">
            <option value="0">Bu kategoriyi Çekme</option>
            <?php 
            $guncel_kategori = get_option("guncel_kat");
            foreach ($kategoriler as $kategori) {
                if($kategori->term_id ==  $guncel_kategori){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                echo "<option $selected value='$kategori->term_id'>$kategori->name</option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="spor">Spor Kategorisini Seçin</label>
        <select id="spor" class="form-control" name="spor">
            <option value="0">Bu kategoriyi Çekme</option>
            <?php 
            $spor_kategori = get_option("spor_kat");
            foreach ($kategoriler as $kategori) {
                if($kategori->term_id ==  $spor_kategori){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                echo "<option $selected value='$kategori->term_id'>$kategori->name</option>";
            } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-warning" name="kaydetbtn">Kaydet</button>
</form>