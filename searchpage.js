$(document).ready(function() {
    function filterUsers(searchInput) {
        var filterValue = searchInput.toLowerCase(); 
        
        $('.user-card').each(function() {
            var userNickname = $(this).find('.nickname').text().toLowerCase(); 
            var userRealName = $(this).find('.real-name').text().toLowerCase(); 
            var userName = userNickname + ' ' + userRealName; 
            
            if (userName.indexOf(filterValue) > -1) {
                $(this).show();
            } else {
                $(this).hide(); 
            }
        });
    }

    $('.searchbar input[name="search"]').on('input', function() {
        var searchInput = $(this).val(); 
        filterUsers(searchInput);
    });

    $(document).on('click', '.viewprofilebtn', function() {
        var userId = $(this).closest('.user-card').find('#user_id').val();
        window.location.href = 'userprofile.php?user_id=' + userId;
    });

    $.ajax({
        url: 'fetch_users.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (!response.error) {
                $('.user-box').empty(); 

                response.forEach(function(user) {
                    var userCard = `
                        <div class="user-card">
                            <input type="hidden" id="user_id" name="user_id" value="${user.user_id}">
                            <div class="user-profile">
                                <img src="${user.profile}" class="user-avatar" alt="User Avatar">
                            </div>
                            <div class="user-info">
                                <div class="user-nametype">
                                    <div class="user-name">
                                        <span class="nickname">${user.nickname}</span>
                                    </div>
                                    <div class="user-type">
                                        <span class="real-name">${user.real_name}</span>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <button class="viewprofilebtn" title="View profile">View profile</button>
                                </div>
                            </div>
                        </div>
                    `;
                    $('.user-box').append(userCard);
                });
            } else {
                console.error('Error fetching users:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching users:', error);
        }
    });
});
