<script>
function show_name(x){
    document.getElementById("username_visible").style.display= x;
}
</script>



<div id="background-color-option">
                    <h5>Username</h5>
                    <div class="select">
                                        <select onchange="show_name(this.value)">
                                            <option value="<?php echo($et2['global_username']) ?>">V or H</option>
                                            <option value="block">Visible</option>
                                            <option value="none">Hidden</option>
                                        </select>
                    </div>
            </div>