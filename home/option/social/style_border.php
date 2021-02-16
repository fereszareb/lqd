<script>
function style_border_change(x){
    for(let i=1;i<10;i++) {
    document.getElementById("social_number"+i).style.border= x;
}}
</script>




<div id="background-color-option">
                    <h5>Style border</h5>
                    <div class="select">
                                        <select onchange="style_border_change(this.value)">
                                            <option value="<?php echo($et2['social_border']) ?>">Select a Style :</option>
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