$(document).ready(function()
{
    $.ajax
    ({
        url: "Resources/Scripts/PHP/RetrieveProfilePicture.php",
        method: "GET",
        success: function (data)
        {
            if (data.status === "success")
            {
                var profileImage = document.getElementById("background");
                profileImage.src = data.image;
            }
            else
            {
                console.error("Erro ao obter a imagem: " + data.message);
            }
        },
        error: function (error)
        {
            console.error("Erro na request: + " + error.responseText);
        }
    });

    $("#imageForm").on("submit", function(e)
    {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax
        ({
            url: "Resources/Scripts/PHP/UploadProfilePicture.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response)
            {
                console.log(response);

                if (response.status === "success")
                {
                    var profileImage = document.getElementById("background");
                    profileImage.src = response.image;
                }
                else
                {
                    console.error("Erro: " + response.message);
                }
            },
            error: function(xhr, status, error)
            {
                console.error("Erro na request: " + xhr.responseText);
            }
        });
    });

    $('#imageInput').on('change', function()
    {
        $('#imageForm').submit();
    });
});