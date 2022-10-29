function carregarFoto(e)
{
    var img = document.querySelector("#fotoCapa");
    
    img.style.backgroundImage = "url()";
    img.src = URL.createObjectURL(e.target.files[0]);
}

function showDuracao(e)
{
    var txt_duracao = document.querySelector("#duracao");
    
    var musica = URL.createObjectURL(e.target.files[0]);

    getDuracao(musica, function(lenght) {
        txt_duracao.value = formatarDuracao(lenght);
    });
}

function formatarDuracao(duracao)
{
    var segundosF = Math.floor(duracao);
    var minutos = Math.floor(segundosF / 60);
    var segundos = segundosF - (minutos * 60);
    var horas = Math.floor(minutos / 60);

    var resultado = str_pad_left(horas, '0', 2) + ':' + str_pad_left(minutos, '0', 2) + ':' + str_pad_left(segundos, '0', 2);

    return resultado;
}

//Substituir os campos vazios de números da Duração em 0
function str_pad_left(string, pad, length) {
    return (new Array(length + 1).join(pad) + string).slice(-length);
}

function getDuracao(src, cb)
{
    var audio = new Audio();
    $(audio).on("loadedmetadata", function(){
        cb(audio.duration);
    });
    audio.src = src;
}