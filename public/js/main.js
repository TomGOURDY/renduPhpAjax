$(document).ready(function () {
    
    //---- Execute Ajax request after a delay after last user input ----
    let typingTimerFriendSearch, typingTimerFriendListSearch;
    let doneTypingInterval = 300;

    $('#friend-list-search').on('input', function(){
        clearTimeout(typingTimerFriendListSearch);

        typingTimerFriendListSearch = setTimeout(getUserList('./include/friendsResult.php', '#friends-list', searchTerm = $('#friend-list-search').val()), doneTypingInterval);
    });
    $('#friend-search').on('input', function(){
        clearTimeout(typingTimerFriendSearch);

        typingTimerFriendSearch = setTimeout(getUserList('./include/userSearchResult.php', '#search-results', searchTerm = $('#friend-search').val()), doneTypingInterval);
    });

    //Click on addFriend button
    $('#search-results').on("click", '.addFriend', function () {
        $.ajax({
            url: "../router.php",
            method: 'post',
            data: { 
                action: 'addFriend',
                friendID: $(this).val()
            },
            success: function() {
                //Reload the friend list and search list
                getUserList('./include/friendsResult.php', '#friends-list', searchTerm = $('#friend-list-search').val());
                getUserList('./include/userSearchResult.php', '#search-results', searchTerm = $('#friend-search').val());
            }
        });
    });
    
    //Click on removeFriend button
    $('#friends-list').on("click", '.removeFriend', function () {
        $.ajax({
            url: "../router.php",
            method: 'post',
            data: { 
                action: 'removeFriend',
                friendID: $(this).val()
            },
            success: function() {
                //Reload the friend list and search list
                getUserList('./include/friendsResult.php', '#friends-list', searchTerm = $('#friend-list-search').val());
                if ($('#friend-search').val()) {
                    getUserList('./include/userSearchResult.php', '#search-results', searchTerm = $('#friend-search').val());
                }
            }
        });
    });

    function getUserList (file, destination, searchTerm = "") {
        $.ajax({
            url: file,
            method: 'post',
            data: {search: searchTerm},
            dataType: 'html',
            success: function(response) {
                $(destination).html(response);
            }
        });
    }

    //Exec
    //Show all friends on page loading
    getUserList('./include/friendsResult.php', '#friends-list');
});