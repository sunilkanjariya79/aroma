<?php global $user;
global $followSuggestions;
?>
<div class="right-panel">
  <div class="side-bar follow-suggestions">
    <h2 class="heading">Suggestions for you</h2>
    <div class="profile-list">
      <?php foreach ($followSuggestions as $usercard) { ?>
        <div class="profile-card-min">
          <a href="?u=<?= $usercard['username'] ?>" class="link-block w-inline-block">
            <img src="assets/images/profile/<?= $usercard['uprofile_photo'] ?>"     class="pcm-img" />
            <div class="pcm-details">
              <p class="pcm-text pcm-username">u/<?= $usercard['username'] ?></p>
              <p class="pcm-text"><?= $usercard['uname'] ?></p>
            </div>
          </a>
          <a class="primery-button pcm-btn w-button followbtn" data-user-id=<?= $usercard['uid'] ?>>Follow</a>
        </div>
      <?php }
       if (count($followSuggestions) < 1) {
        echo "<p>No Suggestions For You</p>";
      }
       ?>
    </div>
  </div>
</div>