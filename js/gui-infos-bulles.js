idMssg = 0;
function addMssg( _lvl, _txt ) {

    var idPrefix = 'mssg';
                            
    var buffer = '';
                            
    switch( _lvl ) {
        case 'error' :
            buffer = '<li id="' + idPrefix + idMssg + '" style="display:none;" class="debugError"><h6>Error<span class="delete"><span class="delete"><a href="#">x</a></span></h6><p>' + _txt + '</p></li>';
            break;
        case 'warning' :
            buffer = '<li id="' + idPrefix + idMssg + '" style="display:none;" class="debugWarning"><h6>Warning<span class="delete"><span class="delete"><a href="#">x</a></span></h6><p>' + _txt + '</p></li>';
            break;
        default:
        case 'information' :
            buffer = '<li id="' + idPrefix + idMssg + '" style="display:none;" class="debugInformation"><h6>Informations<span class="delete"><span class="delete"><a href="#">x</a></span></h6><p>' + _txt + '</p></li>';
            break;
        case 'okay' :
            buffer = '<li id="' + idPrefix + idMssg + '" style="display:none;" class="debugOkay"><h6>Okay<span class="delete"><span class="delete"><a href="#">x</a></span></h6><p>' + _txt + '</p></li>';
            break;
    }
                            
    $( '#displayMssg' ).append( buffer );
    $( '#' + idPrefix + idMssg ).fadeIn( 'fast', 'easeInOutCubic' ).delay( 3000 ).fadeOut( 'fast' );
    idMssg++;
}