function openNav() {
    $('#side-menu').css({'width':'150px','display':'block','transition':'0.3s'})
    $('.resp-menu').css({'visibility':'hidden'})
}

function closeNav() {
    $('#side-menu').css({'width':'0','display':'none'})
    $('.resp-menu').css({'visibility':'visible'})
}