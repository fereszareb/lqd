<script>
    function border_image_radius(x){
    document.getElementById("img_view").style.borderRadius= x;
}
</script>





<div id="background-color-option">
                    <h5>Border shape</h5>
                    <div class="select">
                                        <select onchange="border_image_radius(this.value)">
                                            <option value="<?php echo($et2['picture_radius']) ?>">Select a Style :</option>
                                            <option value="15px 5px 15px 5px">Style 1</option>
                                            <option value="15px 50px ">Style 2</option>
                                            <option value="10px 30px">Style 3</option>
                                            <option value="15px">Style 4</option>
                                            <option value="2px">Style 5</option>
                                            <option value="15px 15px 5px 5px">Style 6</option>
                                            <option value="4px">Style 7</option>
                                            <option value="20px">Style 8</option>
                                            <option value="60px">Style 9</option>
                                        </select>
                    </div>
            </div>