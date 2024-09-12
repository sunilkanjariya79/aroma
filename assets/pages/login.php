<html>
  <head>
    <link rel="stylesheet" href="style/test.css"><div class="log-reg-container">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
      <div class="log-reg-side">
        <img
          src="images/bookshelf.png"
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
              action="casual-post-wall.php"
            >
              <input
                class="log-reg-field w-input"
                maxlength="20"
                name="email"
                placeholder="Email"
                type="email"
              /><input
                class="log-reg-field w-input"
                maxlength="256"
                name="pass"
                placeholder="Your Password"
                type="text"
              />
              <div class="lr-field-box lr-fb-2">
                <a href="#/register" class="side-bar-heading lr-link">New user? Register</a
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
  </body>
</html>