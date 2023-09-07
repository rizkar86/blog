$(document).ready(function () {
    // Listen for changes to the category dropdown
    $('#category').change(function () {
        // Get the selected category ID
        var categoryId = $(this).val();
        var url ='posts/filterByCategory/' + categoryId;
        fetchPosts(url, 'category', categoryId);
    });


  /*   $(document).on('click', '.category-span', function()  {
        // Get the category ID from the data attribute
        var categoryId = $(this).data('category-id');
        var url ='posts/filterByCategory/' + categoryId;
        fetchPosts(url, 'category', categoryId);
    });
    $(document).on('click', '.user-link', function(e)  {
        e.preventDefault();
        // Get the category ID from the data attribute
        var userId = $(this).data('user-id');
        var url ='posts/filterByAuthor/' + userId;
        fetchPosts(url, 'user', userId);
     }); */

     $(".deletePost").click(function(){


    });
    function fetchPosts(url, type, id) {
        // Make an AJAX request to fetch posts based on the selected category
        $.ajax({
            type: 'GET',
            url: url, // Replace with your actual route
            dataType: 'json',
            success: function (data) {
                // Update the posts container with the new posts
                $('#posts-container').empty();
                  // Iterate through the JSON data and append new posts
                  $.each(data, function (index, post) {
                    console.log(post);
                    // Create a new post card element and append it to the container
                    var postCard = `
                        <div class="card col-3 mb-4" style="width: 18rem;">
                            <!-- Card Image -->
                            <img src="http://bolg/img/${post.image}" class="card-img-top" alt="...">
                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="card-title">${post.title}</h5>
                                <p class="card-text">${post.created_at}</p>
                                `;
                                console.log(post.categories);
                                postCard += `Posted by: `;
                                //post users
                                $.each(post.users, function (index, user) {
                                    postCard += `<a href="#" class="link-opacity-75-hover user-link" data-user-id="${user.id}">${user.name}</a> , `;
                                });
                                postCard += `<br> Categories: `;
                                // post categories
                                $.each(post.categories, function (index, category) {
                                    postCard += `<a href="#"  class="link-opacity-75-hover category-span" data-category-id="${category.id}">${category.name}</a> , `;
                                });
                                postCard += `
                                <p class="card-text">${post.short_content}</p>
                                <div class="mt-auto align-self-start">
                                    <a href="/posts/${post.id}" class="btn btn-primary ">show</a>
                                    <a href="/posts/${post.id}/edit" class="btn btn-success ">edit</a>
                                    <a class="btn btn-danger deletePost" data-id="${post.id}" >Delete</a>
                                </div>


                            </div>
                        </div>
                    `;
                    $('#posts-container').append(postCard);
                });
                if(type == 'category') {
                    $('#category option').removeAttr('selected');
                    $('#category option[value="' + id + '"]').attr('selected', 'selected');
                }
                else if(type == 'user') {
                    $('#user option').removeAttr('selected');
                    $('#user option[value="' + id + '"]').attr('selected', 'selected');
                }


            },
            error: function () {
                alert('An error occurred while fetching posts.');
            }
        });
    }
    $(document).on('click', '.deletePost', function(e)  {
        e.preventDefault();
        var id = $(this).attr('data-id');

        $.ajax({
            type: 'DELETE',
            url: '/posts/deletePost/'+id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                alert(data.message);
                location.reload();
            }
        });

    });

    $(document).on('click', '.simple-pagination a', function(event){
        event.preventDefault();

        // get href attr
        var href = $(this).attr('href');
        var page = href.split('page=')[1];
        var url = window.location.href;
        var type = (url.split('/')[3] != '') ? url.split('/')[3] : 'blog';
        console.log(type);
        var id = url.split('/')[4];


        fetch_data(page, type, id,url);
     });

     function fetch_data(page, type, id, url)
     {
        if(type == 'blog') {
            // remove last '/' from url
            url = url.substring(0, url.length - 1);
        }

        console.log(url);
        var _token = $("."+type+" input[name=_token]").val();
        $.ajax({
        url:url+"/fetch-data",
        method:"POST",
        data:{_token:_token, page:page, type:type, id:id},
        success:function(data)
        {
            console.log(data);
            $('.'+type+'-posts').html(data);
           // $('html, body').animate({ scrollTop: $('.blog-posts').offset().top  - 200}, 'slow');
          // $(window).scrollTop($('.'+type+'-posts').offset().top - 200);
        }
        });
        // make focus on top page

     }


});
