<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password · amamazahub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-sm bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Reset Password</h2>

    <form id="resetForm" class="space-y-5">
      <input type="hidden" id="token" name="token" />

      <!-- New password -->
      <div class="relative">
        <label for="password1" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
        <input type="password" id="password1" name="password1" required
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10">
        <span id="password1Error" class="text-red-500 text-xs hidden"></span>
      </div>

      <!-- Confirm password -->
      <div class="relative">
        <label for="password2" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
        <input type="password" id="password2" name="password2" required
               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10">
        <span id="password2Error" class="text-red-500 text-xs hidden"></span>
      </div>

      <button type="submit"
              class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition duration-200">
        Reset Password
      </button>

      <div id="formMessage" class="text-sm text-center hidden"></div>
    </form>

    <div class="mt-6 flex flex-col items-center space-y-2">
      <a href="@login" class="text-blue-600 hover:underline text-sm">Login</a>
    </div>
  </div>

  <script>
    // --- Extract token from URL ---
    const params = new URLSearchParams(window.location.search);
    const token = params.get("token");
    $("#token").val(token);

    if (!token) {
      $("#formMessage").removeClass("hidden").addClass("text-red-500").text("Invalid or missing reset token.");
      $("#resetForm").hide();
    } else {
      // Verify token before showing form
      $.ajax({
        url: "@auth/action",
        method: "POST",
        data: { action: "verify_token", token },
        dataType: "json",
        success: function (res) {
          if (!res.success) {
            $("#formMessage").removeClass("hidden").addClass("text-red-500").text(res.message);
            $("#resetForm").hide();
          }
        },
        error: function () {
          $("#formMessage").removeClass("hidden").addClass("text-red-500").text("Server error verifying token.");
          $("#resetForm").hide();
        }
      });
    }

    // --- Form submit handler ---
    $("#resetForm").on("submit", function (e) {
      e.preventDefault();

      const password1 = $("#password1").val().trim();
      const password2 = $("#password2").val().trim();
      const token = $("#token").val();

      $("#password1Error, #password2Error, #formMessage").addClass("hidden").text("");

      let valid = true;
      if (password1.length < 6) {
        $("#password1Error").removeClass("hidden").text("Password must be at least 6 characters.");
        valid = false;
      }
      if (password1 !== password2) {
        $("#password2Error").removeClass("hidden").text("Passwords do not match.");
        valid = false;
      }
      if (!valid) return;

      $.ajax({
        url: "@auth/action",
        method: "POST",
        data: {
          action: "reset_password",
          token,
          password1,
          password2
        },
        dataType: "json",
        success: function (res) {
          if (res.success) {
            $("#formMessage").removeClass("hidden").addClass("text-green-600").text(res.message);
            setTimeout(() => window.location.href = res.redirect || "@login", 2000);
          } else {
            $("#formMessage").removeClass("hidden").addClass("text-red-500").text(res.message);
          }
        },
        error: function () {
          $("#formMessage").removeClass("hidden").addClass("text-red-500").text("Server error. Try again later.");
        }
      });
    });
  </script>
</body>
</html>
