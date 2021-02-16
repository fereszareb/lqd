<script>
    function border_image(x){
    document.getElementById("img_view").style.border= x;
}
</script>



<div id="background-color-option">
                    <h5>Border</h5>
                    <div class="select">
                                        <select onchange="border_image(this.value)">
                                            <option value="<?php echo($et2['picture_border']) ?>">Select a Style :</option>
                                            <option value="dotted">dotted</option>
                                            <option value="dashed">dashed</option>
                                            <option value="solid">solid</option>
                                            <option value="double">double</option>
                                            <option value="groove">groove</option>
                                            <option value="ridge">ridge</option>
                                            <option value="inset">inset</option>
                                            <option value="outset">outset</option>
                                            <option value="none">none</option>
                                        </select>
                    </div>
            </div>