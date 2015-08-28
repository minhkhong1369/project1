   <?php include('../includes/header.php');?>
   <?php include('../includes/mysqli_connect.php');?>
     <?php include('../includes/sidebar-admin.php');?>
    
   
           <?php 
           if($_SERVER['REQUEST_METHOD']=='POST'){//Gia tri ton tai, xy ly form
                $errors=array();
           
           if(empty($_POST['category'])){
                $errors[]= "category";
           }else{
                $cat_name = mysqli_real_escape_string($dbc,strip_tags($_POST['category']));//chuyen ky tu dat biet ve dang chuoi
           }
            if(isset($_POST['position']) && filter_var($_POST['position'],FILTER_VALIDATE_INT, array('min_range'=>1))){
                $position = $_POST['position'];
            }
            else {
                $errors[]= "position";
            }
            if(empty($errors)){//neu khong co loi xay ra thi chen vao csdl
               $q = "INSERT INTO categories (user_id, cat_name, position) VALUE (1, '{$cat_name}', $position)";
               $r = mysqli_query($dbc,$q) or die ("Query {$q} \n<br/> My SQL Error:" .mysqli_error($dbc));
           if(mysqli_affected_rows($dbc)==1){
                 $messages = "<p class='success'>The catagory was added successfully.</p>";   
           }else{
                $messages = "<p class='warning'>Could not added to the database dut to a system error.</p>";
           }
           }else {
                 $messages = "<p class='warning'> Please fill all the required fields.</p>";
           }
           }//end main if submit condition
           ?>
    <div id="content">
           <h2>Create a categories</h2>
           <?php if(!empty($messages)) echo $messages;?>
        <form id="add_cat" action="" method="post">
            <fieldset>
            <legend>Add category</legend>
          
            <div>
            <label for="category">Catagory name:<span class="required">*</span>
                <?php 
                if(isset($errors)&& in_array('category',$errors)){
                echo "<p class ='warning'>Please fill in the catagory name</p>";
                }
                ?>
            </label>   
            <input type="text" name="category" id="category" value="<?php if(isset($_POST['catagory'])) echo strip_tags($_POST['catagory'])?>" size="20" maxlength="80" tabindex='1'/>
            </div>
            <div>
            <label for="position">Position:<span class="required">*</span></label>
            <select name="position" tabindex='2'>
            <?php 
                $q= "SELECT count(cat_id) AS count FROM categories";
                $r= mysqli_query($dbc,$q)or die ("Query {$q} \n<br/> My SQL Error:" .mysqli_error($dbc));
                if(mysqli_num_rows($r)==1){
                    list($num) = mysqli_fetch_array($r,MYSQLI_NUM);
                    for($i=1;$i<=$num+1;$i++){ //tao vong for de ra gia tri option cong them 1 cho position
                        echo "<option value='{$i}'";
                            if(isset($_POST['position'])&& $_POST['position']==$i) echo "selected='selected'";
                        echo ">".$i."</option>";
                    }
                }
             ?>
            </select>
            </div>  </fieldset>
                <p><input type="submit" name="submit" value="Add Category"/></p>
        </form>

    </div><!--end content-->
     <?php include('../includes/sidebar-b.php');?>
     <?php include('../includes/footer.php');?>