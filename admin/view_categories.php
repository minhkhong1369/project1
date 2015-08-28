   <?php include('../includes/header.php');?>
   <?php include('../includes/mysqli_connect.php');?>
   <?php include('../includes/functions.php');?>
     <?php include('../includes/sidebar-admin.php');?>
    <div id="content">
    <h2>Manager Category</h2>
    <table>
    <thead>
    <tr>
        <th><a href="view_category.php?sort=cat">Category</a></th>
        <th><a href="view_category.php?sort=pos">Position</a></th>
        <th><a href="view_category.php?sort=by">Posted By</a></th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    
    <tbody>
    <?php 
        //sap xep thu tu cua table thead
        if(isset($_GET['soft'])){
            switch($GET['soft']){
                case 'cat':
                $order_by='cat_name';
                break;
                case 'pos':
                $order_by='position';
                break;
                case 'by':
                $order_by='name';
                break;
                default:
                $order_by='position';
            }//end switch 
        }//end isset($_GET['soft'])
        //truy xuat csdl hien thi tren category
        $q = "SELECT c.cat_id, c.cat_name, c.position, c.user_id, CONCAT_WS('', first_name, last_name) AS name";
        $q .= " FROM categories AS c";
        $q .= " JOIN users AS u";
        $q .= " USING(user_id)";
        $q .= " ORDER BY $order_by ASC"; 
        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);
        while($cats=mysqli_fetch_array($r, MYSQLI_ASSOC)){
        echo "<tr>
        <td>{$cats['cat_name']}</td>
        <td>{$cats['position']}</td>
        <td>{$cats['name']}</td>
        <td><a class='edit' href=''>Edit</a></td>
        <td><a class='delete' href=''>Delete</a></td>
             </tr>
         ";   
        }
    ?>
    
    </tbody>
    </table>
    </div>        
   
          
     <?php include('../includes/sidebar-b.php');?>
     <?php include('../includes/footer.php');?>