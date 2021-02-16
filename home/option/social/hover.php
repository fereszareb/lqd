<script>
function hover_change(x){
    inn = x ;
    }

</script>




<div id="background-color-option">
                    <h5>Hover</h5>
                    <div class="select">
                                        <select onchange="hover_change(this.value)">
                                            <option value="<?php echo($et2['social_hover']) ?>">Select a Color :</option>
                                            <option value="black">Black</option>
                                            <option value="white">White</option>
                                            <option value="rgb(57,177,193)">Color 1</option>
                                            <option value="rgb(223,234,244)">Color 2</option>
                                            <option value="rgb(57,166,193)">Color 5</option>
                                            <option value="rgb(255,193,178)">Color 6</option>
                                            <option value="rgb(255,152,120)">Color 7</option>
                                            <option value="rgb(114,193,213)">Color 8</option>
                                            <option value="rgb(254,155,29)">Color 9</option>
                                        </select>
                    </div>
            </div>