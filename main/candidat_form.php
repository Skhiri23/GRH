
<div class="formbold-main-wrapper">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="formbold-form-wrapper">
    <form action="" method="POST">
      <div class="formbold-input-flex">
        <div>
          <label for="firstname" class="formbold-form-label"> Nom </label>
          <input
            type="text"
            name="firstname"
            id="firstname"
            placeholder=""
            class="formbold-form-input"
          />
        </div>

        <div>
          <label for="lastname" class="formbold-form-label"> Prenom </label>
          <input
            type="text"
            name="lastname"
            id="lastname"
            placeholder=""
            class="formbold-form-input"
          />
        </div>
      </div>

      <div class="formbold-input-flex">
        <div>
            <label for="email" class="formbold-form-label"> Email </label>
            <input
            type="email"
            name="email"
            id="email"
            placeholder="example@email.com"
            class="formbold-form-input"
            />
        </div>

        <div>
            <label class="formbold-form-label">Genre</label>

            <select class="formbold-form-input" name="occupation" id="occupation">
            <option value="male">homme</option>
            <option value="female">femme</option>
            </select>
        </div>
      </div>

      <div class="formbold-mb-3 formbold-input-wrapp">
        <label for="phone" class="formbold-form-label"> Telephone </label>

        <div>
          <input
            type="text"
            name="phone"
            id="phone"
            placeholder=""
            class="formbold-form-input"
          />
        </div>
      </div>
      <div class="formbold-mb-3">
        <label for="dob" class="formbold-form-label"> Quand peux-tu commencer? </label>
        <input type="date" name="dob" id="dob" class="formbold-form-input" />
      </div>

      <div class="formbold-mb-3">
        <label for="address" class="formbold-form-label"> Adresse</label>

        <input
          type="text"
          name="address"
          id="address"
          placeholder=""
          class="formbold-form-input formbold-mb-3"
        />

      <div class="formbold-mb-3">
        <label for="message" class="formbold-form-label">
        Lettre de motivation
        </label>
        <textarea
          rows="6"
          name="message"
          id="message"
          class="formbold-form-input"
        ></textarea>
      </div>
      <div class="formbold-form-file-flex">
        <label for="upload" class="formbold-form-label">
        Télécharger le CV
        </label>
        <input
          type="file"
          name="upload"
          id="upload"
          class="formbold-form-file"
        />
      </div>



      <button type="submit" class="formbold-btn">Appliquer maintenant</button>
    </form>
  </div>
</div>
<?php
require_once('connect.php');

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['occupation'];
    $phone = $_POST['phone'];
    $start_date = $_POST['dob'];
    $address = $_POST['address'];
    $cover_letter = $_POST['message'];
    

    $sql = "INSERT INTO Candidature (post_id, firstname, lastname, email, gender, phone, start_date, address, cover_letter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("issssssss", $post_id, $firstname, $lastname, $email, $gender, $phone, $start_date, $address, $cover_letter);

    if ($stmt->execute()) {
        echo "Votre candidature a été soumise avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
?>


<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: 'Inter', sans-serif;
  }
  .formbold-mb-3 {
    margin-bottom: 15px;
  }

  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    background: white;
    padding: 40px;
  }

  .formbold-img {
    display: block;
    margin: 0 auto 45px;
  }

  .formbold-input-wrapp > div {
    display: flex;
    gap: 20px;
  }

  .formbold-input-flex {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
  }
  .formbold-input-flex > div {
    width: 50%;
  }
  .formbold-form-input {
    width: 100%;
    padding: 13px 22px;
    border-radius: 5px;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
    resize: none;
  }
  .formbold-form-input::placeholder,
  select.formbold-form-input,
  .formbold-form-input[type='date']::-webkit-datetime-edit-text,
  .formbold-form-input[type='date']::-webkit-datetime-edit-month-field,
  .formbold-form-input[type='date']::-webkit-datetime-edit-day-field,
  .formbold-form-input[type='date']::-webkit-datetime-edit-year-field {
    color: rgba(83, 99, 135, 0.5);
  }

  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
  .formbold-form-label {
    color: #07074D;
    font-weight: 500;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 10px;
  }

  .formbold-form-file-flex {
    display: flex;
    align-items: center;
    gap: 20px;
  }
  .formbold-form-file-flex .formbold-form-label {
    margin-bottom: 0;
  }
  .formbold-form-file {
    font-size: 14px;
    line-height: 24px;
    color: #536387;
  }
  .formbold-form-file::-webkit-file-upload-button {
    display: none;
  }
  .formbold-form-file:before {
    content: 'Upload file';
    display: inline-block;
    background: #EEEEEE;
    border: 0.5px solid #FBFBFB;
    box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
    padding: 3px 12px;
    outline: none;
    white-space: nowrap;
    -webkit-user-select: none;
    cursor: pointer;
    color: #637381;
    font-weight: 500;
    font-size: 12px;
    line-height: 16px;
    margin-right: 10px;
  }

  .formbold-btn {
    text-align: center;
    width: 100%;
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
    margin-top: 25px;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-w-45 {
    width: 45%;
  }
</style> 