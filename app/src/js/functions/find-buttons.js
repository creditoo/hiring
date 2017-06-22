/**
* Plugin Authoring
*
* @author Will Angélico <willangelico@gmail.com>
*
* Plugins to consume external REST API with JS or PHP
* Use ECMAScript 6 (ES2015)
* 
**/

;(function($){

	"use strict";

	$.fn.FindButton = function( params ){

		// Default options
		const options = $.extend({
			form		: '.find-form',
			buttonJS	: '.find-js',
			buttonPHP	: '.find-php',
			input		: '.find-ipt',
			classErro   : 'error',
			result		: '#actual-result',
			saved		: '#last-result'
		}, params);
		
		// Plugin variables
		const $self = $(this);

		// DOM elements
		const elements = {
			$eBtnJS 	: $(options.buttonJS),
			$eBtnPHP 	: $(options.buttonPHP),
			$result		: $(options.result),
			$saved		: $(options.saved)
		}

		// Methods
		const methods = {
			init: function(){
				events.eButtons();
				methods.mountLast(methods.getStorage());
			},
			checkIpt: function( ipt ){
				if( ipt )
					return true;
				return false;
			},
			apiJS: function( ipt ){
				$.ajax({ 
				   	type: "GET",
				   	dataType: "jsonp",
				   	url: `https://api.github.com/users/${ipt}`,
				   	success: function(data){
				   		if(data.data.message){
				   			methods.mountError(data.data.message);							
						}else{
				   			elements.$result.html(methods.mountResult(data.data));
				   			methods.saveStorage(data.data);
				   		}
				   	}
				});
			},
			apiPHP: function( ipt ){	
				$.ajax({ 
				   	type: "POST",
				   	dataType: "html",
				   	url: "core",
				   	data: { 'user_account': ipt },
				   	success: function(data){        
				    	elements.$result.html(data);
				    	methods.saveStorage({'login': ipt});
				   	}
				});

			},
			mountResult: function( data ){				
				let result = 
					`<div id="account" class="row">
						<div class="account-info col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<div class="account-img">
								<img src="${data.avatar_url}" alt="${data.name}" class="img-responsive img-circle" />
							</div>							
						</div>
						<div class="account-bio col-xs-12 col-sm-12 col-md-8 col-lg-8">
							<h3 class='account-name'>
								<a href="${data.html_url}" target="_blank">
									${data.name}
								</a>
							</h3>
							<div class="account-location">
								${data.location}
							</div>
							<div class="account-follows">
								<div class="account-followers">
									<strong>Followers</strong>
									<span>${data.followers}</span>
								</div>
								<div class="account-following">
									<strong>Following</strong>
									<span>${data.following}</span>
								</div>
							</div>
							<div class="account-publics">
								<div class="account-public-repos">
									<strong>Repositories</strong>
									<span>${data.public_repos}</span>
								</div>
								<div class="account-public-gists">
									<strong>Gists</strong>
									<span>${data.public_gists}</span>
								</div>
							</div>
							<div class="account-company">
								<strong>Company: </strong>
								<span>${data.company}</span>
							</div>
							<div class="account-company">
								<strong>Site: </strong>
								<a href="${data.blog}" target="_blank">${data.blog}</a>
							</div>
							<div class="account-bio">
								<p>"${data.bio}"</p>
							</div>
						</div>
					</div>`;
				return result
			},
			mountError: function( msg ){
				let error = `<div>User Account ${msg}</div>`;
			   	alert(error);
			},
			saveStorage: function( data ){								
				let accountList	= methods.getStorage();
				accountList.unshift(data);				
				localStorage.setItem("accounts", JSON.stringify(accountList));
				methods.mountLast(accountList);
			},
			getStorage: function(){
				let accountList = [];
				if(localStorage.getItem("accounts"))
					accountList = JSON.parse(localStorage.getItem("accounts"));	
				
				return accountList;
			},
			mountLast: function( list ){
				const listItems = list.map((l) =>
					`<li>${l.login}</li>`
				)
				let lastList = `<ul>${listItems}</ul>`;
				elements.$saved.html(lastList);				
			}
		}


		// Events
		const events = {
			eButtons : function(){
				
				elements.$eBtnJS.click(function(event){					
					let ipt = $(this).parents('form').find(options.input).val();
					if(!methods.checkIpt(ipt)){
						alert("empty input");
						return false;						
					}					
					methods.apiJS(ipt);
					return false;
				});
				elements.$eBtnPHP.click(function(event){
					let ipt = $(this).parents('form').find(options.input).val();
					if(!methods.checkIpt(ipt)){
						alert("empty input");
						return false;						
					}
					methods.apiPHP(ipt);
					return false;
				});
			}			
		}

		methods.init();
	};
})( jQuery );