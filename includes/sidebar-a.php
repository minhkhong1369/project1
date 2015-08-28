    <div id="content-container">
        <div id="section-navigation">
    	   <ul class="navi">
           <?php 
                // xac dinh cat_id to dam link
                if(isset($_GET['cid']) && filter_var($_GET['cid'],FILTER_VALIDATE_INT, array('min_range'=>1))){
                $cid = $_GET['cid'];
                $pid = NULL;
            } elseif(isset($_GET['pid']) && filter_var($_GET['pid'],FILTER_VALIDATE_INT, array('min_range'=>1))){
                $pid=$_GET['pid'];
                $cid = NULL;
                }
                else{
                    $cid=NULL;
                    $pid=NULL;
                } 
            
                //cau lenh truy xuat catagory
               $q = "SELECT cat_name, cat_id FROM categories ORDER BY position ASC";
               $r = mysqli_query($dbc,$q);
               confirm_query($r,$q);
               // lay category tu CSDL
               while($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                 echo "<li><a href ='index.php?cid={$cats['cat_id']}'";
                    if($cats['cat_id']== $cid) echo "class='selected'";
                 echo ">".$cats['cat_name']. "</a>";
                 //cau lenh truy xuat page
                     $q1 = "SELECT page_name, page_id FROM pages WHERE cat_id={$cats['cat_id']} ORDER BY position ASC";
                     $r1 = mysqli_query($dbc,$q1);
                     confirm_query($r1,$q1);
                     //lay page tu CSDL
                     echo "<ul class='pages'>";
                     while($pages=mysqli_fetch_array($r1, MYSQLI_ASSOC)){
                        echo "<li><a href='index.php?pid={$pages['page_id']}'";
                            if($pages['page_id']== $pid) echo "class='selected'";
                        echo ">".$pages['page_name']. "</a></li>";
                        //end while pages
                     }
                     echo "</ul>";
                 echo "</li>";
                            
               }//end while cats
           
           ?>
    	   </ul>
    </div><!--end section-navigation-->