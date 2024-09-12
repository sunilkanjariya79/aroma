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
          <h2 class="secondary-heading"> Create Account</h2>
        </div>
        <div class="form-block w-form">
          <form
            method="get"
            class="register-form"
          >
            <a onClick= "" class="reg-edit-img-in w-inline-block"
              ><img
                src="images/typcn_plus.svg"
                loading="lazy"
                alt=""
                class="image-2" /></a
            >
            <div class="pop-up-window">
              <div class="pop-up">
                <div class="pop-up-heading">
                  <h2 class="heading-2">heading</h2>
                  <img src="images/charm_cross.svg" loading="lazy" width="32" height="32" alt="">
                </div>
                <div class="pop-up-content">
                  <input type="file" name="profile-photo" id="profile-photo">
                  <a onClick class="primery-button"> Add</a>
                </div>
              </div>
            </div>
            
            <input
              class="log-reg-field w-input"
              maxlength="20"
              name="field"
              data-name="Field"
              placeholder="Email"
              type="email"
              id="field"
              required=""
            /><input
              class="log-reg-field w-input"
              maxlength="256"
              name="field-2"
              data-name="Field 2"
              placeholder="Example Text"
              type="text"
              id="field-2"
              required=""
            />
            <div class="lr-field-box">
              <input
                class="log-reg-field lg-field w-input"
                maxlength="256"
                name="field-2"
                data-name="Field 2"
                placeholder="Example Text"
                type="text"
                id="field-2"
                required=""
              /><select
                id="Gender"
                name="Gender"
                data-name="Gender"
                required=""
                class="log-reg-field lg-field w-select"
              >
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            </div>
            <textarea
              placeholder="Example Text"
              maxlength="220"
              id="field-4"
              name="field-4"
              data-name="Field 4"
              class="log-reg-field reg-edit-about w-input"
            ></textarea
            ><input type="date" class="log-reg-field" /><input
              class="log-reg-field w-input"
              maxlength="256"
              name="field-2"
              data-name="Field 2"
              placeholder="Example Text"
              type="text"
              id="field-2"
              required=""
            /><input
              class="log-reg-field w-input"
              maxlength="256"
              name="field-2"
              data-name="Field 2"
              placeholder="Example Text"
              type="text"
              id="field-2"
              required=""
            />
            <div class="lr-field-box lr-fb-2">
              <a href="login.php" class="side-bar-heading lr-link">Log in</a
              ><input
                type="submit"
                data-wait="Please wait..."
                class="primery-button lr-btn w-button"
                value="Submit"
              />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html> 
