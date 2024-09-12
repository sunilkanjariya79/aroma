<?php
include_once('assets/pages/header.php');?>
      <div class="log-reg-side">
        <img
          src="assets/images/site-meta/bookshelf.png"
          loading="lazy"
          width="Auto"
          height="Auto"
          alt=""
        
          class="log-reg-img"
        />
      </div>
      <div class="log-reg-form-container">
        <div class="log-reg-form">
          <div>
            <h2 class="secondary-heading"> Log in </h2>
          </div>
          <div class="form-block w-form">
            <form
              method="post"
              class="register-form"
              action="assets/php/action.php?login"
            >
              <input
                class="log-reg-field w-input"
                maxlength="20"
                name="umail"
                placeholder="Email"
                type="email"
              /><input
                class="log-reg-field w-input"
                maxlength="256"
                name="upassword"
                placeholder="Your Password"
                type="text"
              />
              <div class="lr-field-box lr-fb-2">
                <a href="?register" class="side-bar-heading lr-link">New user? Register</a
                ><input
                  type="submit"
                  class="primery-button lr-btn w-button"
                  value="Log In"
                />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
include_once('assets/pages/footer.php');?>