<?php
global $user; //function ni bare hovathi global keyword thi get karviyu
<li><a href="?editprofile">edit profile</a></li>
<img src="images/<?=$user['profile_pic']?>" alt=""> //by dedfault image mate
// click button and add post
<a href="addppost" class="add a modal class for bootstrap">Post</a>
?>