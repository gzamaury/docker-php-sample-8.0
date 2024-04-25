<?php

namespace pagination;

class Paginator
{
    public $perPage;

    public function __construct($perPage)
    {
        $this->perPage = $perPage;
    }

    public function getAllPageLinks($count, $href)
    {
        $output = '';
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }

        if ($this->perPage != 0) {
            $pages  = ceil($count / $this->perPage);
        }

        if ($pages > 1) {
            if ($_GET["page"] == 1) {
                $output = $output
                   . '<span class="link first disabled">&#8810;</span>'
                   . '<span class="link disabled">&#60;</span>';
            } else {
                $output = $output
                   . '<a class="link first" onclick="getResult(\'' . $href . (1) . '\')" >&#8810;</a>'
                   . '<a class="link" onclick="getResult(\'' . $href . ($_GET["page"] - 1) . '\')" >&#60;</a>';
            }

            if (($_GET["page"] - 3) > 0) {
                if ($_GET["page"] == 1) {
                    $output = $output
                       . '<span id=1 class="link current">1</span>';
                } else {
                    $output = $output
                       . '<a class="link" onclick="getResult(\'' . $href . '1\')" >1</a>';
                }
            }

            if (($_GET["page"] - 3) > 1) {
                $output = $output . '<span class="dot">...</span>';
            }

            for ($i = ($_GET["page"] - 2); $i <= ($_GET["page"] + 2); $i++) {
                if ($i < 1) {
                    continue;
                }
                if ($i > $pages) {
                    break;
                }
                if ($_GET["page"] == $i) {
                    $output = $output
                       . '<span id=' . $i . ' class="link current">' . $i . '</span>';
                } else {
                    $output = $output
                       . '<a class="link" onclick="getResult(\'' . $href . $i . '\')" >' . $i . '</a>';
                }
            }

            if (($pages - ($_GET["page"] + 2)) > 1) {
                $output = $output . '<span class="dot">...</span>';
            }

            if (($pages - ($_GET["page"] + 2)) > 0) {
                if ($_GET["page"] == $pages) {
                    $output = $output
                       . '<span id=' . ($pages) . ' class="link current">' . ($pages) . '</span>';
                } else {
                    $output = $output
                       . '<a class="link" onclick="getResult(\'' . $href .  ($pages) . '\')" >' . ($pages) . '</a>';
                }
            }

            if ($_GET["page"] < $pages) {
                $output = $output
                   . '<a  class="link" onclick="getResult(\'' . $href . ($_GET["page"] + 1) . '\')" >&#62;</a>'
                   . '<a  class="link" onclick="getResult(\'' . $href . ($pages) . '\')" >&#8811;</a>';
            } else {
                $output = $output
                   . '<span class="link disabled">&#62;</span>'
                   . '<span class="link disabled">&#8811;</span>';
            }
        }

        return $output;
    }
    public function getPrevNext($count, $href)
    {
        $output = '';
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        if ($this->perPage != 0) {
            $pages  = ceil($count / $this->perPage);
        }
        if ($pages > 1) {
            if ($_GET["page"] == 1) {
                $output = $output
                   . '<span class="link disabled first">Prev</span>';
            } else {
                $output = $output
                   . '<a class="link first" onclick="getResult(\'' . $href . ($_GET["page"] - 1) . '\')" >Prev</a>';
            }

            if ($_GET["page"] < $pages) {
                $output = $output . '<a  class="link" onclick="getResult(\'' . $href . ($_GET["page"] + 1) . '\')" >Next</a>';
            } else {
                $output = $output . '<span class="link disabled">Next</span>';
            }
        }

        return $output;
    }
}
