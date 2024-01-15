<div class="splash">
    <div class="splash-header">
        <div class="row d-flex justify-content-center">
            <img style="width: 200px" class="h-auto" src="{{ asset('assets/admin/logo.png') }}" alt="" srcset="">
            <h5 class="text-white fw-bold text-center mt-3">Warung Pink Cafe</h5>
        </div>
    </div>
</div>

<script>
    var splashScreen = document.querySelector('.splash');
    setTimeout(()=>{
        splashScreen.classList.add('hiddensplash')
    },1200)
</script>
