
function CONSTVAR(){}

CONSTVAR.SEARCH_STRING_LENGTH = 64;
CONSTVAR.SUCCESS = 'success';
CONSTVAR.LOGIN = 'login';
CONSTVAR.HAS_SHOP = 'has_shop';
CONSTVAR.ARTICLE_LIST_NO = 4;

CONSTVAR.DOMAIN = 'http://www.cms.org/';




function login_page()
{
	return  {
		'/goods/upload'		:	'/goods/upload',
		'/goods/update'		:	'/goods/update',
		'/goods/manage'		:	'/goods/manage',
		'/goods/list'		:	'/goods/list',
		'/shop/home'		:	'/shop/home',
		'/shop/create'		:	'/shop/create',
	}
}


