jQuery.noConflict();

! function( $ ) {
  $( document ).ready( function() {
    $( '.tpm-title-cell' ).each( function( i ) {
      $( this ).attr( 'id', 'tab-' + i );
    });
    
    $( '.tpm-title-cell:last-child' ).parent().width( $( '.tpm-title-cell:last-child' ).parent().parent().width() - 5 );
  
  
    // Show Content on click
    var $el, elCount;
    $( '.tpm-title-cell' ).click( function() {
      $el = $( this );
      
      // Remove and add active
      $el.parent().find( '.active-tab' ).removeClass( 'active-tab' );
      $el.addClass( 'active-tab' );
      
      // Show right content
      elCount = parseInt( $el.attr( 'id' ).replace( 'tab-', '' ) ) + 1;
      $( '.active-content-tab' ).removeClass( 'active-content-tab' );
      $( '.tpm-content-cell:nth-child(' + elCount + ')').addClass( 'active-content-tab' );
    });
    
    // First one should be active 
    $( '.tpm-title-cell' ).first().trigger( 'click' );
    
    
    
    // Don't do it for second level
    $( '.tpm-container-element-depth-1 .tpm-title-cell' ).unbind( 'click' );
    
  });

} ( jQuery );