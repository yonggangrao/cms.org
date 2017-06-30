


function redirect(url)
{
	window.location.href = url;
}



function get_uri()
{
	return window.location.pathname;
}


function trim(str)
{
	len = str.length;
	
	for(i=0;i<len;i++)
	{
		if(str.charAt(i)!=' ')
		{
			break;
		}
	}
	for(j=len-1;j>=0;j--)
	{
		if(str.charAt(j)!=' ')
		{
			break;
		}
	}
	if(i>j)
	{
		return '';
	}
	return str.substring(i,j+1);
}


function json_decode(data)
{
	return eval('(' + data + ')');
}


function verify_email(email)
{
	var regexp=/^[\w-]+@[\w-\.]+\.([\w-]+)$/gi;  
	
	if(!regexp.exec(email))
	{
		return false;
	}
	else
	{
		return true;
	}
}