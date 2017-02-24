/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


textarea.onkeypress = function(e){
    if (e.keyCode == 13){
        if (e.preventDefault) e.preventDefault();
        return false;
    }
};