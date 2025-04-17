<?php
function showAlert($message, $type = 'error')
{
  $_SESSION['alert'] = [
    'message' => $message,
    'type' => $type
  ];
}

function displayAlert()
{
  if (isset($_SESSION['alert'])) {
    $alertClass = ($_SESSION['alert']['type'] == 'success') ? 'success-alert' : 'error-alert';
    $alertIcon = ($_SESSION['alert']['type'] == 'success') ? '✓' : '✕';

    echo '<div class="alert ' . $alertClass . '">';
    echo '<div class="alert-icon">' . $alertIcon . '</div>';
    echo '<div class="alert-message" style="flex: 1; margin-left: 10px; margin-top: 5px;">' . $_SESSION['alert']['message'] . '</div>';
    echo '</div>';

    unset($_SESSION['alert']);
  }
}

function getAlertStyles()
{
  return '
  <style>
      .alert {
          display: flex;
          align-items: flex-start;
          padding: 16px 20px;
          border-radius: 12px;
          margin-bottom: 20px;
          font-family: "Poppins", sans-serif;
          font-size: 14px;
          gap: 12px;
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
          line-height: 1.4;
          opacity: 1;
          transition: opacity 0.5s ease, transform 0.5s ease;
          animation: fadeIn 0.4s ease-in-out;
      }
  
      @keyframes fadeIn {
          from { opacity: 0; transform: translateY(-8px); }
          to { opacity: 1; transform: translateY(0); }
      }
  
      .alert.fade-out {
          opacity: 0;
          transform: translateY(-10px);
      }
  
      .success-alert {
          background-color: #e6f4ea;
          border: 1px solid #a5d6a7;
          color: #2e7d32;
      }
  
      .error-alert {
          background-color: #fdecea;
          border: 1px solid #f5c6cb;
          color: #c62828;
      }
  
      .alert-icon {
          margin-top: 2px;
          display: flex;
          align-items: center;
          justify-content: center;
          width: 32px;
          height: 32px;
          border-radius: 50%;
          font-weight: bold;
          font-size: 18px;
          color: #fff;
          flex-shrink: 0;
      }
  
      .success-alert .alert-icon {
          background-color: #4caf50;
      }
  
      .error-alert .alert-icon {
          background-color: #f44336;
      }
  
      .alert-message {
        flex: 1;
        margin-left: 10px;
        padding-top: 2px; /* atau coba 4px jika perlu lebih turun */
        line-height: 1.4;
      }
  </style>
  
  <script>
      // Auto dismiss after 4 seconds
      window.addEventListener("DOMContentLoaded", () => {
          const alert = document.querySelector(".alert");
          if (alert) {
              setTimeout(() => {
                  alert.classList.add("fade-out");
                  setTimeout(() => alert.remove(), 500);
              }, 4000); // 4 seconds before fading
          }
      });
  </script>
  ';
}
?>