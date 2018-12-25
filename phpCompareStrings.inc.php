<?php

    /**
     * This class compares two strings and outputs the similarities  as percentage
     *
     * @author Rochak Chauhan <rochak@dmwtechnologies.com>
     */
    class PhpCompareStrings {

        private $str1 = "";
        private $str2 = "";
        private $arr1 = array();
        private $arr2 = array();

        /**
         * Contructor fucntion
         *
         * @param string $str1
         * @param string $str2
         * @return string
         */
        function __construct($str1, $str2) {
            $str1 = trim($str1);
            $str2 = trim($str2);
            if ($str1 == "") {
                trigger_error("First parameter can not be left blank", E_USER_ERROR);
            } elseif ($str2 == "") {
                trigger_error("Second parameter can not be left blank", E_USER_ERROR);
            } else {
                $this->str1 = $str1;
                $this->str2 = $str2;
                $this->arr1 = explode(" ", $str1);
                $this->arr2 = explode(" ", $str2);
            }
        }

        /**
         * Function to compare two strings and return the similarity in percentage
         *
         * @access public
         * @return float
         */
        public function getSimilarityPercentage() {
            $str1 = $this->str1;
            $str2 = $this->str2;
            $tmp1 = $this->arr1;
            $c1 = count($tmp1);
            $tmp2 = $this->arr2;
            $c2 = count($tmp2);
            $count = $c1;
            $t1 = $tmp1;
            $t2 = $tmp2;
            if ($c2 > $c1) {
                $count = $c2;
                $t1 = $tmp1;
                $t2 = $tmp2;
            }
            $result = array();
            for ($i = 0; $i < $count; $i++) {
                if (@$t1[$i] == @$t2[$i]) {
                    $result[] = 1;
                    $resultSame[] = 0;
                } else {
                    $result[] = 0;
                    $resultSame[] = levenshtein(@$t1[$i], @$t2[$i]);
                }
            }
            $countArray = array_count_values($result);
            $one = 0;
            $zero = 0;
            if (isset($countArray[0])) {
                $zero = $countArray[0];
            }
            if (isset($countArray[1])) {
                $one = $countArray[1];
            }
            if ($one === 0) {
                $percent = number_format(0, 2);
            } elseif ($zero === 0) {
                $percent = number_format(100, 2);
            } else {
                $per = ($one / ($one + $zero)) * 100;
                $percent = number_format($per, 2);
            }
            if ($c1 === $c2) {
                $words1 = array_diff_assoc($tmp1, $tmp2);
                $words2 = array_diff_assoc($tmp2, $tmp1);
                $sum = array_sum($resultSame);
                $sum = ($sum / 100);
                $percent = ($percent - $sum);
            }
            return $percent;
        }

        /**
         * Function to compare two strings and return the difference in percentage
         *
         * @access public
         * @return float
         */
        public function getDifferencePercentage() {
            $per = $this->getSimilarityPercentage();
            return 100 - $per;
        }

    }

?>