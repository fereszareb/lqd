<script>
    function size_image(x){
    document.getElementById("img_view").style.height= x;
    document.getElementById("img_view").style.width= x;
}
</script>





<div id="background-color-option">
                    <h5>Image size</h5>
                    <div class="select">
                                        <select onchange="size_image(this.value)">
                                            <option value="<?php echo($et2['picture_size']) ?>">Select a Size :</option>
                                            <option value="150px">150px</option>
                                            <option value="120px ">120px</option>
                                            <option value="100px">100px</option>
                                            <option value="90px">90px</option>
                                            <option value="85px">85px</option>
                                            <option value="80px">80px</option>
                                            <option value="75px">75px</option>
                                            <option value="70px">70px</option>
                                            <option value="65px">65px</option>
                                        </select>
                    </div>
            </div>