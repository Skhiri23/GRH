<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login_v1/index.php');
    exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-nav">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GRH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 1-2-2H10a2 2 0 0 1-2 2zm4.142-2.858A5.027 5.027 0 0 0 13 8V7a4 4 0 0 0-4-4V2a2 2 0 0 0-4 0v1a4 4 0 0 0-4 4v1a5.027 5.027 0 0 0 .858 2.858 1.5 1.5 0 0 1-.358 2.141L4 13h8l-.642-1.858a1.5 1.5 0 0 1-.358-2.141z"/>
                        </svg>
                         <span id="notification-count" class="badge bg-danger"></span>
                    </a>
                    <div id="notification-dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                        <a class="dropdown-item" href="#">No new notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewcontrat.php">Print Contrat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="demande_conge.php">Congé</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Liste_payement.php">Print bulletin salaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Liste_des_FormationEMployé.php">Inscrire Formation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="modifier_compte.php">modifier Compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="send_notification.php">Envoyer Notification</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text">
                        Profil Employé | <a href="logout.php">Déconnexion</a>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        fetchNotifications();

        function fetchNotifications() {
            $.ajax({
                url: 'fetch_notifications.php',
                method: 'GET',
                success: function(data) {
                    console.log("Notifications fetched: ", data);  
                    const notifications = JSON.parse(data);
                    let notificationDropdown = $('#notification-dropdown');
                    notificationDropdown.empty();
                    let unreadCount = 0;

                    notifications.forEach(notification => {
                        let notificationItem = `<a class="dropdown-item ${notification.lu ? '' : 'font-weight-bold'}" href="#">
                            ${notification.message}
                            <button class="btn btn-sm btn-link mark-as-read" data-id="${notification.id}">Marquer comme lu</button>
                            <button class="btn btn-sm btn-link delete-notification" data-id="${notification.id}">Supprimer</button>
                        </a>`;
                        notificationDropdown.append(notificationItem);

                        if (!notification.lu) {
                            unreadCount++;
                        }
                    });

                    $('#notification-count').text(unreadCount);

                    $('.mark-as-read').click(function() {
                        let notificationId = $(this).data('id');
                        markAsRead(notificationId);
                    });

                    $('.delete-notification').click(function() {
                        let notificationId = $(this).data('id');
                        deleteNotification(notificationId);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching notifications: ', textStatus, errorThrown);  
                }
            });
        }

        function markAsRead(notificationId) {
            $.ajax({
                url: 'mark_as_read.php',
                method: 'POST',
                data: { notification_id: notificationId },
                success: function() {
                    fetchNotifications();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error marking as read: ', textStatus, errorThrown);  
                }
            });
        }

        function deleteNotification(notificationId) {
            $.ajax({
                url: 'delete_notification.php',
                method: 'POST',
                data: { notification_id: notificationId },
                success: function() {
                    fetchNotifications();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting notification: ', textStatus, errorThrown);  
                }
            });
        }
    });
</script>
