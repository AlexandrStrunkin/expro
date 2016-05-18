<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);

    $arViewModeList = $arResult['VIEW_MODE_LIST'];

    $arViewStyles = array(
        'LIST' => array(
            'CONT' => 'bx_sitemap',
            'TITLE' => 'bx_sitemap_title',
            'LIST' => 'bx_sitemap_ul',
        ),      	
    );
    $arCurView = $arViewStyles[$arParams['VIEW_MODE']];

    $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
    $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
    $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


?>


<div class="catalogPopupWrapper"><?
        if (0 < $arResult["SECTIONS_COUNT"])
        {
        ?>
        <ul>
            <?        
                $intCurrentDepth = 1;
                $boolFirst = true;
                foreach ($arResult['SECTIONS'] as &$arSection)
                {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

                    if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
                    {
                        if (0 < $intCurrentDepth)
                            echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
                    }
                    elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
                    {
                        if (!$boolFirst)
                            echo '</li>';
                    }
                    else
                    {
                        while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
                        {
                            echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
                            $intCurrentDepth--;
                        }
                        echo str_repeat("\t", $intCurrentDepth-1),'</li>';
                    }

                    echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
                ?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                <div data-attr="test">
                    <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>">
                        <? echo $arSection["NAME"];?>
                    </a>
                </div>
                <?if($arSection['RELATIVE_DEPTH_LEVEL']==1){?>
                    <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>" class="realSectionHref">�������</a> 
                    <?}?> 
                <?

                    $intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
                    $boolFirst = false;
                }
                unset($arSection);
                while ($intCurrentDepth > 1)
                {
                    echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
                    $intCurrentDepth--;
                }
                if ($intCurrentDepth > 0)
                {
                    echo '</li>',"\n";
                }

            ?>
        </ul>
        <?
            echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
        }
    ?>   
</div>

<?
    //�������� ��� ���� ��������� "�����"
    if (Cmodule::IncludeModule('asd.iblock')) {
        $arFields = CASDiblockTools::GetIBUF(6);   
        $videoPath = CFile::GetPath($arFields["UF_VIDEO"]);
        if ($videoPath) {
        ?>
        <div class="downloadCatalogVideo"><a href="<?=$videoPath?>" download>������� ����������������</a></div>
        <?
        }
    }
?>