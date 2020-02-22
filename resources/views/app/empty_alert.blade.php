<div class='text-center mx-auto {{ isset($width) ? "w-100" : "w-75" }} alert shadow-lg my-3 alert-dismissible fade show shadow'
     role="alert" id="">
    <div class='card-body'>
        <button class="btn close float-right btn-hover rounded animate action-button" data-dismiss="alert">
            <i class="fa fa-times fa-fw"></i>
        </button>
        <h5 class='card-title'>Ooops</h5>
        <p class='card-text'>{{ $message }}</p>
        <button type="button" onclick="document.getElementById('{{ $element }}').click()"
                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>
            Create One Now!
        </button>
    </div>
</div>