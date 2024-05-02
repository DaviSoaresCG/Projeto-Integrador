function SumScore(){
    let pontos = [];
    let sum = 0;

    for(let i = 0; i < 16; i++){
        pontos[i] = parseInt(document.getElementById('ponto' + (i+1)).value);
        sum = sum + pontos[i];
    }

    document.getElementById('pontuacao').innerHTML = "Pontos " + sum;

}
    
   
