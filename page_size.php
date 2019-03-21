<?php
class page_size
{
    private $total_size=0;

    public function calculate($url)
    {
        $baseurl = parse_url($url, PHP_URL_SCHEME). '://'.parse_url($url, PHP_URL_HOST);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($curl);

        $this->total_size+=curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD);

        $dom = new DOMDocument();
        @$dom->loadHTMLFile($url);

        //javascript, css, ico and img elements are contained
        $element_array=array('script'=>'src','link'=>'href','img'=>'src');

        foreach ($element_array as $type=>$source)
        {
            $elements = $dom->getElementsByTagName($type);

            foreach ($elements as $element)
            {
                foreach ($element->attributes as $attr)
                {
                    $name = $attr->nodeName;
                    $value = $attr->nodeValue;

                    if($name==$source)
                    {
                        $chk_file=$baseurl.'/'.$value;

                        $curl = curl_init($chk_file);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                        curl_exec($curl);
                        $this->total_size+=curl_getinfo($curl, CURLINFO_SIZE_DOWNLOAD);
                    }
                }
            }
        }

        return round(($this->total_size/1000000),2);//mb
    }
}
?>