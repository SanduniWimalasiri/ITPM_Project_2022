
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Item</h1>
        <br><br>


                
        <form action="" method="POST" enctype="multipart/form-data">

        <table border="0" class="tbl-30">
            <tr>
                <td>Title :</td>
                <td>
                    <input type="text" name="title" placeholder=" Title of the Item">
                </td>    
            </tr>

            <tr>
                <td>Description :</td>
                <td>
                    <textarea name="description" cols="30"  rows="5" placeholder=" Description of the Item"></textarea>
                </td>    
            </tr>

            <tr>
                <td>Price :</td>
                <td>
                    <input type="number" name="price" placeholder=" Price of the Item">
                </td>    
            </tr>

            <tr>
                <td>current Image :</td>
                <td>
                Display the Image if Available
                </td>    
            </tr>

            <tr>
                <td>Select Image :</td>
                <td>
                <input type="file" name="image" >
                </td>    
            </tr>

            <tr>  
                <td>Category :</td>
                <td>
                    <select name="category">
                    
                  
                    </select>
                </td>
            </tr>

            <tr>
                <td>Active :</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>    
            </tr>

            

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Update Item" class="btn-secondary">
                </td>
              
            </tr>



        </table>
        </form>


                          
    </div>
</div>



<?php include('partials/footer.php') ?>








