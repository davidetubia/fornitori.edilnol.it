<?php
$user = $this->session->userdata('user'); 
$btnClasses = "border border-1 p-3 mb-3 bg-eblu-900 text-white"
?>

<div class="max-w-screen-xl mx-auto p-4">
    <div class="py-3">
        <h1 class="text-eblu-900 text-3xl"><?php echo $user->denominazione; ?></h1>
    </div>
    <div class="container flex flex-col gap-4">
        <div class="w-full rounded-lg shadow-lg md:mt-0 xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-3 tracking-tight md:text-2xl">
                    Modalità esperto
                </h1>
                <hr>
                <p>Prediligiamo i listini caricati con la modalità esperto</p>
                <?php echo form_open_multipart('upload/expert', array('class' => 'space-y-4 md:space-y-6')); ?>
                    <label for="large-file-input" class="sr-only">Choose file</label>
                    <input type="file" name="listino" id="listino" class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500
                        file:bg-transparent file:border-0
                        file:bg-gray-100 file:mr-4
                        file:py-3 file:px-4 file:sm:py-5
                    ">
                    <button type="submit" class="w-full text-white bg-eblu-900 hover:bg-eblu-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Carica listino</button>
                </form>
            </div>
        </div>

        <div class="w-full bg-white rounded-lg shadow-lg md:mt-0 xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Modalità manuale
                </h1>
                <hr>
                <p>Usa la modalità standard per...</p>
                <?php echo form_open_multipart('upload/basic', array('class' => 'space-y-4 md:space-y-6', 'id' => 'form-basic')); ?>
                    <label for="large-file-input" class="sr-only">Choose file</label>
                    <input type="file" name="listino" id="listino" class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500
                        file:bg-transparent file:border-0
                        file:bg-gray-100 file:mr-4
                        file:py-3 file:px-4 file:sm:py-5
                    ">
                    <button type="submit" class="w-full text-white bg-eblu-900 hover:bg-eblu-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Carica listino</button>
                </form>
            </div>
        </div>
    </div>

    <div id="resultOver" class="hidden fixed bg-black/60 backdrop-blur top-0 left-0 w-full h-full">
        <div class="flex flex-col items-center justify-center bg-white rounded-xl w-2/3 h-96 shadow-lg fixed top-0 inset-x-0 mx-auto inset-y-0 my-auto p-10">
            <div id="resultTitle" class="text-2xl success"></div>
            <div id="resultSubtitle" class="text-base"></div>
            <a href="#" id="resultButton" class="p-3 bg-eblu-900 text-white rounded-lg mt-4 success">Pulsante</a>
        </div>
    </div>
</div>


<script>
    $('#form-basic').on('submit', function(e){
        var data = new FormData(this);
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('upload/basic'); ?>",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',     
            success: function(data) {
                data = $.parseJSON(data);
                data.success === true
                ? classnames={box: 'btn-success bg-green-600', text:'text-green-600'}
                : classnames={box: 'btn-error bg-red-600', text:'text-red-600'}
                $('#resultOver').addClass('flex').removeClass('hidden');
                $('#resultTitle').html(data.title).addClass(classnames.text);
                $('#resultSubtitle').html(data.subtitle);
                $('#resultButton').attr('href', data.href);
                $('#resultButton').html(data.button).addClass(classnames.box);
            }
        })
    })

    $(document).on('click', '.btn-success', function(){
        // $('#resultOver').addClass('hidden').removeClass('flex');
    })

    $(document).on('click', '.btn-error', function(){
    })
</script>