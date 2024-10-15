<?php
    require "header.php";
    require "connect.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<style>
    .chat-footer {
        position: relative;
    }

    .emoji-picker {
        position: absolute;
        bottom: calc(100% + 5px);
        left: 0;
        display: none;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 15px;
        border-radius: 10px;
        z-index: 1000;
        width: 300px;
        height: 400px;
        overflow-y: auto;

    }

    .emoji-picker.active {
        transform: translateY(0);
        opacity: 1;
    }

    .emoji-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }

    .emoji {
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .emoji:hover {
        transform: scale(1.2);
    }

    .green-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: green;
        border-radius: 50%;
        margin-right: 5px;
    }

    .dropdown {
        position: relative;
    }

    .vertical-dots-btn {
        background: none;
        border: none;
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border: 1px solid #ccc;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        background: none;
        text-align: left;
        width: 100%;
    }

    .dropdown-item:hover {
        background: #f0f0f0;
    }

    .circle-image {
        width: 100%;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
    }
</style>

<!-- chat section start -->
<section class="chat-section pt-120 mt-lg-0 mt-sm-15 mt-5">
    <div class="row gx-6">
        <div class="col-lg-4 position-relative" id="chat-list">
            <div class="chat-list-area px-lg-6 px-4 py-lg-8 py-4 bgn-4 rounded">
                <div class="msg-list-user-info d-flex mb-lg-4 mb-2">
                    <div class="msg-sender-list-thumb position-relative circle-image">
                        <img class="w-100 rounded-circle" src="<?php echo $_SESSION["LoginProfile"] ?>" alt="userthumb">
                        <div class="online-dot online" style="margin-right:4px;"></div>
                    </div>
                    <div class="msg-list-user-heading flex-grow-1 text-center me-5">
                        <h1>CHAT</h1>
                    </div>
                </div>
                <div class="search-chat mb-lg-6 mb-4">
                    <form action="#" id="search-form">
                        <div class="input-area d-flex align-items-center gap-3 rounded-4">
                            <i class="ti ti-search"></i>
                            <input type="text" id="search-input" placeholder="Search......" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="chat-list-wrapper" data-lenis-prevent style="height: 100vh;"> 
                    <ul class="chat-list d-grid gap-lg-6 gap-3">

                        <?php 
                            $loggedInUserId = $_SESSION["LoginId"];

                            $queryMessages = "SELECT 
                                u.userid,
                                u.username, 
                                u.userprofile, 
                                c.message_text, 
                                c.sent_time,
                                (SELECT COUNT(*) FROM chat WHERE (sender_id = u.userid AND receiver_id = $loggedInUserId) OR (receiver_id = u.userid AND sender_id = $loggedInUserId)) AS message_count,
                                c.sender_id, 
                                c.receiver_id
                            FROM friends f
                            JOIN userreg u ON (f.user_one = u.userid OR f.user_two = u.userid)
                            LEFT JOIN (
                                SELECT sender_id, receiver_id, message_text, sent_time
                                FROM chat
                                WHERE (sender_id = $loggedInUserId OR receiver_id = $loggedInUserId)
                            ) c ON (
                                (c.sender_id = u.userid AND c.receiver_id = $loggedInUserId) OR 
                                (c.receiver_id = u.userid AND c.sender_id = $loggedInUserId)
                            )
                            WHERE (f.user_one = $loggedInUserId OR f.user_two = $loggedInUserId)
                            AND u.userid != $loggedInUserId
                            AND c.sent_time = (
                                SELECT MAX(sent_time)
                                FROM chat
                                WHERE (sender_id = u.userid AND receiver_id = $loggedInUserId) OR 
                                    (receiver_id = u.userid AND sender_id = $loggedInUserId)
                            )
                            GROUP BY u.userid
                            ORDER BY c.sent_time DESC";

                            $requesttdb = mysqli_query($con, $queryMessages);

                            if (!$requesttdb) {
                                die("Database query failed: " . mysqli_error($con));
                            }

                            $newMessages = [];
                            if (mysqli_num_rows($requesttdb) > 0) {
                                while ($row = mysqli_fetch_assoc($requesttdb)) {
                                    $imagePath = htmlspecialchars($row['userprofile']);
                                    
                                    if (!empty($row['message_text'])) {
                                        $newMessages[] = [
                                            'username' => htmlspecialchars($row['username']),
                                            'image' => $imagePath,
                                            'message' => htmlspecialchars($row['message_text']),
                                            'sent_time' => $row['sent_time'],
                                            'message_count' => $row['message_count'],
                                            'userid' => $row['userid'],
                                            'sender_id' => $row['sender_id'],
                                            'receiver_id' => $row['receiver_id'],
                                        ];
                                    }
                                }
                            }

                            if (!empty($newMessages)) {
                                foreach ($newMessages as $friend) {
                                    $sentTimeFormatted = date('h:i A', strtotime($friend['sent_time']));
                                    $messageCount = $friend['message_count'];
                                    ?>
                                    <li class="chat-item rounded-4" data-friend-id="<?= $friend['userid'] ?>" 
                                    onclick="updateChatHeader('<?= $friend['image'] ?>', '<?= htmlspecialchars($friend['username']) ?>', '<?= $friend['userid'] ?>'); markAsRead(this);">
                                        <a href="#" class="d-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="msg-sender-list-thumb position-relative circle-image">
                                                    <img class="w-100 rounded-circle" src="<?= $friend['image'] ?>" alt="user thumb">
                                                    <div class="online-dot online" style="margin-right:4px;"></div>
                                                </div>
                                                <div class="msg-list-user-info">
                                                    <span class="fs-five tcn-1 mb-1">
                                                        <?= htmlspecialchars($friend['username']) ?>
                                                    </span>
                                                    <span class="fs-sm tcn-6">
                                                        <?php 
                                                        if ($friend['sender_id'] == $loggedInUserId) {
                                                            echo "You: " . htmlspecialchars($friend['message']);
                                                        } else {
                                                            echo htmlspecialchars($friend['message']);
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="msg-status" style="display: flex; flex-direction:column;">
                                                <span class="fs-sm messagetime tcp-2" style="<?= $friend['sender_id'] == $loggedInUserId ? 'color: grey;' : ''; ?>">
                                                    <?= $sentTimeFormatted ?>
                                                </span>
                                                <?php if ($friend['sender_id'] != $loggedInUserId) { ?>
                                                    <span class="msg-count fs-sm mt-1" style="margin-left: auto;">
                                                        <?= $messageCount > 0 ? $messageCount : '' ?>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </li>
                                    <?php 
                                }
                            }

                            $queryFriends = "
                                SELECT u.userid, u.username, u.userprofile, 
                                (SELECT COUNT(*) FROM chat WHERE (sender_id = u.userid AND receiver_id = $loggedInUserId) OR (receiver_id = u.userid AND sender_id = $loggedInUserId)) AS message_count
                                FROM friends f
                                JOIN userreg u ON (f.user_one = u.userid OR f.user_two = u.userid)
                                WHERE (f.user_one = $loggedInUserId OR f.user_two = $loggedInUserId)
                                AND u.userid != $loggedInUserId";

                            $requestdb = mysqli_query($con, $queryFriends);

                            if (!$requestdb) {
                                die("Database query failed: " . mysqli_error($con));
                            }

                            if (mysqli_num_rows($requestdb) > 0) {
                                while ($row = mysqli_fetch_assoc($requestdb)) {
                                    $imagePath = htmlspecialchars($row['userprofile']);
                                    $messageCount = htmlspecialchars($row['message_count']);
                                    $friendId = htmlspecialchars($row['userid']);

                                    ?>
                                    <li class="chat-item rounded-4" data-friend-id="<?= $friendId ?>" 
                                        onclick="<?= ($imagePath && htmlspecialchars($row['username']) && $friendId) ? "updateChatHeader('$imagePath', '" . htmlspecialchars($row['username']) . "', $friendId)" : "return false;" ?>">

                                        <a href="#" class="d-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="msg-sender-list-thumb position-relative circle-image">
                                                    <img class="w-100 rounded-circle" src="<?= $imagePath ?>" alt="user thumb">
                                                </div>
                                                <div class="msg-list-user-info">
                                                    <span class="fs-five tcn-1 mb-1">
                                                        <?= htmlspecialchars($row['username']) ?>
                                                    </span>
                                                    <span class="fs-sm tcn-6">Tap to chat</span>
                                                </div>
                                            </div>

                                        </a>
                                    </li>
                                    <?php 
                                }
                            } else {
                                echo "Add Friends for chat.";
                            }
                        ?>

                    </ul>
                </div>
            </div>
        </div>

        <?php
            $friendId = isset($_GET['friendId']) ? $_GET['friendId'] : null;
            $loggedInUserId = $_SESSION['LoginId'];

            if ($friendId) {
                $friendQuery = "SELECT username, userprofile FROM userreg WHERE userid = $friendId";
                $friendResult = mysqli_query($con, $friendQuery);
                $friend = mysqli_fetch_assoc($friendResult);

                $userImageQuery = "SELECT userprofile FROM userreg WHERE userid = $loggedInUserId";
                $userImageResult = mysqli_query($con, $userImageQuery);
                $loggedInUserImage = mysqli_fetch_assoc($userImageResult)['userprofile'];

                $friendImage = $friend['userprofile'];
            }
        ?>

        <div class="col-lg-8 chat-wrapper-hidden" style="display: none;">
            <div class="chat-wrapper p-lg-6 p-sm-4 p-2 bgn-4 rounded">
                <div class="chat-header d-between pb-xl-8 pb-4 bb">
                    <div class="d-flex align-items-center gap-2">
                        <button class="chat-list-toggle-btn bttn d-lg-none">
                            <i class="ti ti-menu-2 tcn-1 fs-2xl"></i>
                        </button>
                        <div class="msg-receiver-user-thumb circle-image">
                            <img class="w-100 rounded-circle" src="<?php echo htmlspecialchars($friendImage); ?>" alt="user thumb">
                        </div>
                        <div class="msg-list-user-info">
                            <span class="fs-five header-name-main tcn-1 mb-1"><?php echo htmlspecialchars($friend['username']); ?></span>
                            
                            <span class="fs-sm tcn-6 d-flex align-items-center">
                                <span class="green-dot"></span> ONLINE
                            </span>
                        </div>
                    </div>
                    <div class="msg-more-option">
                        <div class="dropdown">
                            <button class="vertical-dots-btn bttn">
                                <i class="ti ti-dots-vertical tcn-6 fs-2xl"></i>
                            </button>
                            <!-- <div class="dropdown-menu">
                                <button class="dropdown-item btn btn-danger">Delete Chat</button>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="chat-body py-6" data-lenis-prevent style="height: 100vh;">
                    <div class="chat-msg-area d-grid gap-lg-6 gap-4 w-100">

                    </div>
                </div>
                
                <div class="chat-footer bt pt-lg-10 pt-sm-8 pt-6">
                    <form method="POST" action="sendmessage.php" class="d-flex align-items-center gap-lg-10 gap-sm-8 gap-4">
                        <div class="emoji-area d-flex align-items-center gap-lg-5 gap-3">
                            <button type="button" class="add-emoji bttn p-0" id="emoji-btn">
                                <i class="ti ti-mood-wink-2 tcn-1 fs-2xl"></i>
                            </button>
                        </div>
                        <div class="input-area d-flex align-items-center gap-3 py-2 pe-2">
                            <input type="text" id="message-input" name="message" class="w-100"
                                placeholder="Type your message..." autocomplete="off">
                            <input type="hidden" name="receiver_id" value="<?php echo htmlspecialchars($friendId); ?>">
                            <button type="submit" name="submittt" class="send-msg bttn">
                                <i class="ti ti-send tcn-0 fs-2xl"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div id="emoji-picker" class="emoji-picker" style="display: none;">
                    <div class="emoji-grid">
                        <span class="emoji">😀</span>
                        <span class="emoji">😃</span>
                        <span class="emoji">😄</span>
                        <span class="emoji">😁</span>
                        <span class="emoji">😆</span>
                        <span class="emoji">😅</span>
                        <span class="emoji">😂</span>
                        <span class="emoji">🤣</span>
                        <span class="emoji">😜</span>
                        <span class="emoji">😝</span>
                        <span class="emoji">😛</span>
                        <span class="emoji">😇</span>
                        <span class="emoji">😉</span>
                        <span class="emoji">😍</span>
                        <span class="emoji">😘</span>
                        <span class="emoji">😗</span>
                        <span class="emoji">😙</span>
                        <span class="emoji">😋</span>
                        <span class="emoji">😎</span>
                        <span class="emoji">😏</span>
                        <span class="emoji">😒</span>
                        <span class="emoji">😞</span>
                        <span class="emoji">😔</span>
                        <span class="emoji">😟</span>
                        <span class="emoji">😕</span>
                        <span class="emoji">🙁</span>
                        <span class="emoji">☹️</span>
                        <span class="emoji">😣</span>
                        <span class="emoji">😖</span>
                        <span class="emoji">😫</span>
                        <span class="emoji">😩</span>
                        <span class="emoji">😢</span>
                        <span class="emoji">😭</span>
                        <span class="emoji">😤</span>
                        <span class="emoji">😠</span>
                        <span class="emoji">😡</span>
                        <span class="emoji">🤬</span>
                        <span class="emoji">😈</span>
                        <span class="emoji">👿</span>
                        <span class="emoji">💀</span>
                        <span class="emoji">👻</span>
                        <span class="emoji">😺</span>
                        <span class="emoji">😸</span>
                        <span class="emoji">😻</span>
                        <span class="emoji">😼</span>
                        <span class="emoji">😽</span>
                        <span class="emoji">🙀</span>
                        <span class="emoji">😿</span>
                        <span class="emoji">😾</span>
                        <span class="emoji">🌟</span>
                        <span class="emoji">✨</span>
                        <span class="emoji">⚡</span>
                        <span class="emoji">💫</span>
                        <span class="emoji">💥</span>
                        <span class="emoji">🔥</span>
                        <span class="emoji">💔</span>
                        <span class="emoji">❤️</span>
                        <span class="emoji">💖</span>
                        <span class="emoji">💕</span>
                        <span class="emoji">💞</span>
                        <span class="emoji">💘</span>
                        <span class="emoji">💝</span>
                        <span class="emoji">🎉</span>
                        <span class="emoji">🎊</span>
                        <span class="emoji">🎈</span>
                        <span class="emoji">🎂</span>
                        <span class="emoji">🍰</span>
                        <span class="emoji">🍕</span>
                        <span class="emoji">🍔</span>
                        <span class="emoji">🌭</span>
                        <span class="emoji">🍿</span>
                        <span class="emoji">🥨</span>
                        <span class="emoji">🍩</span>
                        <span class="emoji">🍪</span>
                        <span class="emoji">🍦</span>
                        <span class="emoji">🍧</span>
                        <span class="emoji">🍨</span>
                        <span class="emoji">☕</span>
                        <span class="emoji">🍵</span>
                        <span class="emoji">🍺</span>
                        <span class="emoji">🍻</span>
                        <span class="emoji">🥂</span>
                        <span class="emoji">🥃</span>
                        <span class="emoji">🍷</span>
                        <span class="emoji">🥤</span>
                        <span class="emoji">🍶</span>
                        <span class="emoji">🍸</span>
                        <span class="emoji">🍼</span>
                        <span class="emoji">💼</span>
                        <span class="emoji">🎒</span>
                        <span class="emoji">👛</span>
                        <span class="emoji">👜</span>
                        <span class="emoji">👝</span>
                        <span class="emoji">👞</span>
                        <span class="emoji">👟</span>
                        <span class="emoji">👠</span>
                        <span class="emoji">👡</span>
                        <span class="emoji">🩴</span>
                        <span class="emoji">🩳</span>
                        <span class="emoji">👕</span>
                        <span class="emoji">👖</span>
                        <span class="emoji">👔</span>
                        <span class="emoji">👗</span>
                        <span class="emoji">👚</span>
                        <span class="emoji">👙</span>
                        <span class="emoji">👘</span>
                        <span class="emoji">💃</span>
                        <span class="emoji">🕺</span>
                        <span class="emoji">🧖‍♀️</span>
                        <span class="emoji">🧖‍♂️</span>
                        <span class="emoji">🌈</span>
                        <span class="emoji">☀️</span>
                        <span class="emoji">🌧️</span>
                        <span class="emoji">❄️</span>
                        <span class="emoji">🌊</span>
                        <span class="emoji">🍀</span>
                        <span class="emoji">🌹</span>
                        <span class="emoji">🌻</span>
                        <span class="emoji">🌼</span>
                        <span class="emoji">🌷</span>
                        <span class="emoji">🍁</span>
                        <span class="emoji">🍂</span>
                        <span class="emoji">🌳</span>
                        <span class="emoji">🌴</span>
                        <span class="emoji">🌵</span>
                        <span class="emoji">🌿</span>
                        <span class="emoji">💐</span>
                        <span class="emoji">🍇</span>
                        <span class="emoji">🍉</span>
                        <span class="emoji">🍊</span>
                        <span class="emoji">🍌</span>
                        <span class="emoji">🍍</span>
                        <span class="emoji">🥭</span>
                        <span class="emoji">🍎</span>
                        <span class="emoji">🍏</span>
                        <span class="emoji">🍒</span>
                        <span class="emoji">🍓</span>
                        <span class="emoji">🥝</span>
                        <span class="emoji">🥥</span>
                        <span class="emoji">🍅</span>
                        <span class="emoji">🥕</span>
                        <span class="emoji">🌽</span>
                        <span class="emoji">🥔</span>
                        <span class="emoji">🍠</span>
                        <span class="emoji">🍆</span>
                        <span class="emoji">🥒</span>
                        <span class="emoji">🥬</span>
                        <span class="emoji">🍚</span>
                        <span class="emoji">🍱</span>
                        <span class="emoji">🍣</span>
                        <span class="emoji">🍜</span>
                        <span class="emoji">🥟</span>
                        <span class="emoji">🍕</span>
                        <span class="emoji">🌮</span>
                        <span class="emoji">🌯</span>
                        <span class="emoji">🍦</span>
                        <span class="emoji">🍨</span>
                        <span class="emoji">🍩</span>
                        <span class="emoji">🍪</span>
                        <span class="emoji">🐶</span>
                        <span class="emoji">🐱</span>
                        <span class="emoji">🐭</span>
                        <span class="emoji">🐹</span>
                        <span class="emoji">🐰</span>
                        <span class="emoji">🐻</span>
                        <span class="emoji">🐼</span>
                        <span class="emoji">🐨</span>
                        <span class="emoji">🐯</span>
                        <span class="emoji">🦁</span>
                        <span class="emoji">🐮</span>
                        <span class="emoji">🐷</span>
                        <span class="emoji">🐸</span>
                        <span class="emoji">🐵</span>
                        <span class="emoji">🐔</span>
                        <span class="emoji">🐧</span>
                        <span class="emoji">🐦</span>
                        <span class="emoji">🐤</span>
                        <span class="emoji">🦉</span>
                        <span class="emoji">🦅</span>
                        <span class="emoji">🐢</span>
                        <span class="emoji">🐍</span>
                        <span class="emoji">🦎</span>
                        <span class="emoji">🐙</span>
                        <span class="emoji">🐠</span>
                        <span class="emoji">🐟</span>
                        <span class="emoji">🐬</span>
                        <span class="emoji">🐳</span>
                        <span class="emoji">🐋</span>
                        <span class="emoji">🦈</span>
                        <span class="emoji">🐊</span>
                        <span class="emoji">🐅</span>
                        <span class="emoji">🦓</span>
                        <span class="emoji">🦒</span>
                        <span class="emoji">🐘</span>
                        <span class="emoji">🐪</span>
                        <span class="emoji">🐫</span>
                        <span class="emoji">🦙</span>
                        <span class="emoji">🦏</span>
                        <span class="emoji">🐉</span>
                        <span class="emoji">🦚</span>
                        <span class="emoji">🦜</span>
                        <span class="emoji">🦢</span>
                        <span class="emoji">🐲</span>
                        <span class="emoji">🐉</span>
                        <span class="emoji">🦕</span>
                        <span class="emoji">🦖</span>
                        <span class="emoji">🐍</span>
                        <span class="emoji">🐋</span>
                        <span class="emoji">🦈</span>
                        <span class="emoji">🐊</span>
                        <span class="emoji">🐲</span>
                        <span class="emoji">🐉</span>
                        <span class="emoji">🐾</span>
                        <span class="emoji">🦋</span>
                        <span class="emoji">🐌</span>
                        <span class="emoji">🐞</span>
                        <span class="emoji">🐜</span>
                        <span class="emoji">🦗</span>
                        <span class="emoji">🪲</span>
                        <span class="emoji">🦠</span>
                        <span class="emoji">🐚</span>
                        <span class="emoji">🦞</span>
                        <span class="emoji">🦐</span>
                        <span class="emoji">🦪</span>
                        <span class="emoji">🦑</span>
                        <span class="emoji">🦀</span>
                        <span class="emoji">🐋</span>
                        <span class="emoji">🦈</span>
                        <span class="emoji">🐊</span>
                        <span class="emoji">🐲</span>
                        <span class="emoji">🐉</span>
                        <span class="emoji">🐍</span>
                        <span class="emoji">🐢</span>
                        <span class="emoji">🦖</span>
                        <span class="emoji">🐳</span>
                        <span class="emoji">🦙</span>
                        <span class="emoji">🦒</span>
                        <span class="emoji">🦓</span>
                        <span class="emoji">🐘</span>
                        <span class="emoji">🐫</span>
                        <span class="emoji">🐪</span>
                        <span class="emoji">🦏</span>
                        <span class="emoji">🐘</span>
                        <span class="emoji">🦓</span>
                        <span class="emoji">🦒</span>
                        <span class="emoji">🦙</span>
                        <span class="emoji">🐕</span>
                        <span class="emoji">🐈</span>
                        <span class="emoji">🐾</span>
                        <span class="emoji">🦮</span>
                        <span class="emoji">🐕‍🦺</span>
                        <span class="emoji">🦸‍♂️</span>
                        <span class="emoji">🦸‍♀️</span>
                        <span class="emoji">🦹‍♂️</span>
                        <span class="emoji">🦹‍♀️</span>
                        <span class="emoji">🧙‍♂️</span>
                        <span class="emoji">🧙‍♀️</span>
                        <span class="emoji">🧝‍♂️</span>
                        <span class="emoji">🧝‍♀️</span>
                        <span class="emoji">🧟‍♂️</span>
                        <span class="emoji">🧟‍♀️</span>
                        <span class="emoji">🧞‍♂️</span>
                        <span class="emoji">🧞‍♀️</span>
                        <span class="emoji">🧚‍♂️</span>
                        <span class="emoji">🧚‍♀️</span>
                        <span class="emoji">👨‍🚀</span>
                        <span class="emoji">👩‍🚀</span>
                        <span class="emoji">👮‍♂️</span>
                        <span class="emoji">👮‍♀️</span>
                        <span class="emoji">👷‍♂️</span>
                        <span class="emoji">👷‍♀️</span>
                        <span class="emoji">👨‍⚕️</span>
                        <span class="emoji">👩‍⚕️</span>
                        <span class="emoji">👨‍🍳</span>
                        <span class="emoji">👩‍🍳</span>
                        <span class="emoji">👨‍🎓</span>
                        <span class="emoji">👩‍🎓</span>
                        <span class="emoji">👨‍🏫</span>
                        <span class="emoji">👩‍🏫</span>
                        <span class="emoji">👨‍💻</span>
                        <span class="emoji">👩‍💻</span>
                        <span class="emoji">👨‍💼</span>
                        <span class="emoji">👩‍💼</span>
                        <span class="emoji">👨‍🔧</span>
                        <span class="emoji">👩‍🔧</span>
                        <span class="emoji">👨‍🔬</span>
                        <span class="emoji">👩‍🔬</span>
                        <span class="emoji">👨‍🎤</span>
                        <span class="emoji">👩‍🎤</span>
                        <span class="emoji">👨‍🎨</span>
                        <span class="emoji">👩‍🎨</span>
                        <span class="emoji">👨‍✈️</span>
                        <span class="emoji">👩‍✈️</span>
                        <span class="emoji">👨‍🚒</span>
                        <span class="emoji">👩‍🚒</span>
                        <span class="emoji">👨‍⚖️</span>
                        <span class="emoji">👩‍⚖️</span>
                        <span class="emoji">👨‍🌾</span>
                        <span class="emoji">👩‍🌾</span>
                        <span class="emoji">👨‍🏭</span>
                        <span class="emoji">👩‍🏭</span>
                        <span class="emoji">👨‍🔧</span>
                        <span class="emoji">👩‍🔧</span>
                        <span class="emoji">👨‍🚀</span>
                        <span class="emoji">👩‍🚀</span>
                        <span class="emoji">👨‍👩‍👧‍👦</span>
                        <span class="emoji">👨‍👩‍👧</span>
                        <span class="emoji">👨‍👩‍👦</span>
                        <span class="emoji">👨‍👩‍👦‍👦</span>
                        <span class="emoji">👨‍👩‍👧‍👧</span>
                        <span class="emoji">👨‍👩‍👧‍👧</span>
                        <span class="emoji">👨‍👩‍👦‍👦</span>
                        <span class="emoji">👨‍👩‍👧‍👧</span>
                        <span class="emoji">👨‍👩‍👦‍👦</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 bydefault" id="chat-wrapper">
            <div class="chat-wrapper bydefault p-lg-6 p-sm-4 p-2 bgn-4 rounded" style="height: 100%;">
                <div class="chat-body d-flex justify-content-center align-items-center" style="height: 100%;">
                    <div class="chat-msg-area d-grid gap-lg-6 gap-4 w-100 text-center">
                        <h4 class="msg-status" style="color:#ffac05;"><b>Join the Kotaku Community!</b></h4>
                        <p>Welcome to Kotaku</p>
                        <p style="margin-top: -20px;">Connect, strategize, and have a blast!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ==== js dependencies start ==== -->
<!-- jquery  -->
<script src="assets/js/jquery.min.js"></script>
<!-- gsap  -->
<script src="assets/js/gsap.min.js"></script>
<!-- gsap scroll trigger -->
<script src="assets/js/ScrollTrigger.min.js"></script>
<!-- lenis  -->
<script src="assets/js/lenis.min.js"></script>
<!-- gsap split text -->
<script src="assets/js/SplitText.min.js"></script>
<!-- tilt js -->
<script src="assets/js/vanilla-tilt.js"></script>
<!-- scroll magic -->
<script src="assets/js/ScrollMagic.min.js"></script>
<!-- animation.gsap -->
<script src="assets/js/animation.gsap.min.js"></script>
<!-- gsap customization  -->
<script src="assets/js/gsap-customization.js"></script>
<!-- apex chart  -->
<script src="assets/js/apexcharts.js"></script>
<!-- swiper js -->
<script src="assets/js/swiper-bundle.min.js"></script>
<!-- magnific popup  -->
<script src="assets/js/magnific-popup.js_1.1.0_jquery.magnific-popup.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- main js  -->
<script src="assets/js/main.js"></script>

<script>


const chatWrapper = document.getElementById('chat-wrapper');
const chatWrapperHidden = document.getElementsByClassName('chat-wrapper-hidden')[0];
const chatList = document.getElementById('chat-list');

// Add classes for responsive design
chatList.classList.add('col-lg-4', 'col-md-6', 'col-sm-8');


// Initialize chat item clicks
function initializeChatItemClicks() {
    document.querySelectorAll('.chat-item').forEach(item => {
        item.addEventListener('click', async function() {
            const friendId = this.getAttribute('data-friend-id');
            fetchChat(friendId);
        });
    });
}

// Check for user_id in URL and fetch chat if present
const urlParams = new URLSearchParams(window.location.search);
const userId = urlParams.get('user_id');
if (userId) {
    fetchChat(userId); // Fetch chat if user_id is present in the URL
}



// Function to fetch chat by friendId
async function fetchChat(id) {
    chatWrapper.style.display = 'none'; 
    chatWrapperHidden.style.display = 'block'; 

    try {
        console.log(`Fetching chat for ID: ${id}`);

        const response = await fetch(`fetch_chat.php?friendId=${id}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.text();
        const chatMsgArea = document.querySelector('.chat-msg-area');
        chatMsgArea.innerHTML = data;

        setUpSearchFunctionality();
        initializeChatItemClicks();

    } catch (error) {
        console.error('Error fetching chat:', error);
    }
}



// Initialize clicks for chat items
initializeChatItemClicks();


    function checkWindowSize() {
        if (window.innerWidth < 992) {
            chatWrapper.style.display = 'none';
            chatWrapperHidden.style.display = 'block'; 
            const firstChatItem = chatList.querySelector('.chat-item');
            if (firstChatItem) {
                firstChatItem.click();
            }
        } else {
            chatWrapper.style.display = 'block';
            chatWrapperHidden.style.display = 'none';
        }
        setUpSearchFunctionality();
    }

    checkWindowSize();
    window.addEventListener('resize', checkWindowSize);



    

    function updateChatHeader(image, username, friendId) {
        document.querySelector('.msg-receiver-user-thumb img').src = image;
        document.querySelector('.msg-list-user-info span.header-name-main').textContent = username;

        function gettingid(friendId) {
            document.querySelector('input[name="receiver_id"]').value = friendId;
        }

        gettingid(friendId);
    }

    function setUpSearchFunctionality() {
        const searchInput = document.getElementById('search-input');
        const originalChatItems = Array.from(document.querySelectorAll('.chat-item'));

        searchInput.removeEventListener('input', filterChatItems);
        searchInput.addEventListener('input', filterChatItems);

        function filterChatItems() {
            const searchTerm = this.value.toLowerCase();

            originalChatItems.forEach(item => {
                const username = item.querySelector('.msg-list-user-info span.fs-five').textContent.toLowerCase(); // Get the username

                if (username.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        initializeChatItemClicks();

        originalChatItems.forEach(item => {
            item.addEventListener('click', function() {
                searchInput.value = '';
                originalChatItems.forEach(i => i.style.display = ''); 
            });
        });
    }







    function markAsRead(listItem) {
        var msgCount = listItem.getElementsByClassName('msg-count')[0];
        if (msgCount) {
            msgCount.remove();
        }

        var timeSpan = listItem.getElementsByClassName('messagetime')[0];
        if (timeSpan) {
            timeSpan.style.color = 'grey';
        }
    }



    const emojiBtn = document.getElementById('emoji-btn');
    const emojiPicker = document.getElementById('emoji-picker');
    const messageInput = document.getElementById('message-input');

    emojiBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';

        const rect = emojiBtn.getBoundingClientRect();
        emojiPicker.style.left = `${rect.left}px`;
        emojiPicker.style.top = `${rect.top + window.scrollY - emojiPicker.offsetHeight - 70}px`;
    });

    document.querySelectorAll('.emoji').forEach(emoji => {
        emoji.addEventListener('click', function () {
            messageInput.value += emoji.textContent;
        });
    });

    document.addEventListener('click', function (event) {
        if (!emojiPicker.contains(event.target) && !emojiBtn.contains(event.target)) {
            emojiPicker.style.display = 'none';
        }
    });

    emojiPicker.addEventListener('wheel', function (event) {
        event.stopPropagation(); 
    });


</script>



</body>

</html>