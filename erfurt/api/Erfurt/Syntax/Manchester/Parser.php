<?php
/* Driver template for the PHP_OWL_To_Erfurt_rGenerator parser generator. (PHP port of LEMON)
*/

/**
 * This can be used to store both the string representation of
 * a token, and any useful meta-data associated with the token.
 *
 * meta-data should be stored as an array
 */
class OWL_To_Erfurt_yyToken implements ArrayAccess
{
    public $string = '';
    public $metadata = array();

    function __construct($s, $m = array())
    {
        if ($s instanceof OWL_To_Erfurt_yyToken) {
            $this->string = $s->string;
            $this->metadata = $s->metadata;
        } else {
            $this->string = (string) $s;
            if ($m instanceof OWL_To_Erfurt_yyToken) {
                $this->metadata = $m->metadata;
            } elseif (is_array($m)) {
                $this->metadata = $m;
            }
        }
    }

    function __toString()
    {
        return $this->_string;
    }

    function offsetExists($offset)
    {
        return isset($this->metadata[$offset]);
    }

    function offsetGet($offset)
    {
        return $this->metadata[$offset];
    }

    function offsetSet($offset, $value)
    {
        if ($offset === null) {
            if (isset($value[0])) {
                $x = ($value instanceof OWL_To_Erfurt_yyToken) ?
                    $value->metadata : $value;
                $this->metadata = array_merge($this->metadata, $x);
                return;
            }
            $offset = count($this->metadata);
        }
        if ($value === null) {
            return;
        }
        if ($value instanceof OWL_To_Erfurt_yyToken) {
            if ($value->metadata) {
                $this->metadata[$offset] = $value->metadata;
            }
        } elseif ($value) {
            $this->metadata[$offset] = $value;
        }
    }

    function offsetUnset($offset)
    {
        unset($this->metadata[$offset]);
    }
}

/** The following structure represents a single element of the
 * parser's stack.  Information stored includes:
 *
 *   +  The state number for the parser at this level of the stack.
 *
 *   +  The value of the token stored at this level of the stack.
 *      (In other words, the "major" token.)
 *
 *   +  The semantic value stored at this level of the stack.  This is
 *      the information used by the action routines in the grammar.
 *      It is sometimes called the "minor" token.
 */
class OWL_To_Erfurt_yyStackEntry
{
    public $stateno;       /* The state-number */
    public $major;         /* The major token value.  This is the code
                     ** number for the token at this stack level */
    public $minor; /* The user-supplied minor token value.  This
                     ** is the value of the token  */
};

// code external to the class is included here
#line 3 "./Parser.y"
require_once '../../erfurt.php';
require_once 'Lexer.php';#line 101 "./Parser.php"

// declare_class is output here
#line 2 "./Parser.y"
class OWLParser#line 106 "./Parser.php"
{
/* First off, code is included which follows the "include_class" declaration
** in the input file. */
#line 5 "./Parser.y"

    	private $lex;
	    function __construct()
	    {
		}
		function parseString($stringToParse){
			$this->lex = new ManchesterLexer($stringToParse);
			while ($this->lex->yylex()) {
				self::doParse($this->lex->token, $this->lex->value);
			}
			self::doParse(0,0);
		}
	#line 124 "./Parser.php"

/* Next is all token values, as class constants
*/
/* 
** These constants (all generated automatically by the parser generator)
** specify the various kinds of tokens (terminals) that the parser
** understands. 
**
** Each symbol here is a terminal symbol in the grammar.
*/
    const NOT_OPERATOR                   =  1;
    const AND_OPERATOR                   =  2;
    const OR_OPERATOR                    =  3;
    const MIN_OPERATOR                   =  4;
    const MAX_OPERATOR                   =  5;
    const EXACTLY_OPERATOR               =  6;
    const HAS_OPERATOR                   =  7;
    const ONLYSOME_OPERATOR              =  8;
    const ONLY_OPERATOR                  =  9;
    const SOME_OPERATOR                  = 10;
    const LPAREN                         = 11;
    const RPAREN                         = 12;
    const LBRACE                         = 13;
    const RBRACE                         = 14;
    const LSQUAREBRACKET                 = 15;
    const RSQUAREBRACKET                 = 16;
    const NUMERIC                        = 17;
    const ALPHANUMERIC                   = 18;
    const COMMA                          = 19;
    const YY_NO_ACTION = 68;
    const YY_ACCEPT_ACTION = 67;
    const YY_ERROR_ACTION = 66;

/* Next are that tables used to determine what action to take based on the
** current state and lookahead token.  These tables are used to implement
** functions that take a state number and lookahead value and return an
** action integer.  
**
** Suppose the action integer is N.  Then the action is determined as
** follows
**
**   0 <= N < self::YYNSTATE                              Shift N.  That is,
**                                                        push the lookahead
**                                                        token onto the stack
**                                                        and goto state N.
**
**   self::YYNSTATE <= N < self::YYNSTATE+self::YYNRULE   Reduce by rule N-YYNSTATE.
**
**   N == self::YYNSTATE+self::YYNRULE                    A syntax error has occurred.
**
**   N == self::YYNSTATE+self::YYNRULE+1                  The parser accepts its
**                                                        input. (and concludes parsing)
**
**   N == self::YYNSTATE+self::YYNRULE+2                  No such action.  Denotes unused
**                                                        slots in the yy_action[] table.
**
** The action table is constructed as a single large static array $yy_action.
** Given state S and lookahead X, the action is computed as
**
**      self::$yy_action[self::$yy_shift_ofst[S] + X ]
**
** If the index value self::$yy_shift_ofst[S]+X is out of range or if the value
** self::$yy_lookahead[self::$yy_shift_ofst[S]+X] is not equal to X or if
** self::$yy_shift_ofst[S] is equal to self::YY_SHIFT_USE_DFLT, it means that
** the action is not in the table and that self::$yy_default[S] should be used instead.  
**
** The formula above is for computing the action when the lookahead is
** a terminal symbol.  If the lookahead is a non-terminal (as occurs after
** a reduce action) then the static $yy_reduce_ofst array is used in place of
** the static $yy_shift_ofst array and self::YY_REDUCE_USE_DFLT is used in place of
** self::YY_SHIFT_USE_DFLT.
**
** The following are the tables generated in this section:
**
**  self::$yy_action        A single table containing all actions.
**  self::$yy_lookahead     A table containing the lookahead for each entry in
**                          yy_action.  Used to detect hash collisions.
**  self::$yy_shift_ofst    For each state, the offset into self::$yy_action for
**                          shifting terminals.
**  self::$yy_reduce_ofst   For each state, the offset into self::$yy_action for
**                          shifting non-terminals after a reduce.
**  self::$yy_default       Default action for each state.
*/
    const YY_SZ_ACTTAB = 74;
static public $yy_action = array(
 /*     0 */    24,   21,   22,   13,   26,   12,    5,   59,    4,   59,
 /*    10 */    59,   28,    7,   67,   18,   43,   14,    6,    9,   59,
 /*    20 */    42,    7,    8,   59,   10,   17,   59,   14,   40,   15,
 /*    30 */    16,    8,   14,   10,    3,    2,    6,    9,   15,   17,
 /*    40 */    30,   14,   23,   34,   38,   17,   39,   14,   19,   17,
 /*    50 */     1,   14,   20,   36,   51,   35,   11,   14,   31,   37,
 /*    60 */    14,   14,   32,   28,   14,    6,    9,   27,   41,   25,
 /*    70 */    29,   51,   11,   33,
    );
    static public $yy_lookahead = array(
 /*     0 */     4,    5,    6,    7,    8,    9,   10,    0,   15,    2,
 /*    10 */     3,   18,    1,   21,   22,   14,   24,    2,    3,   12,
 /*    20 */    16,    1,   11,   16,   13,   22,   19,   24,   25,   18,
 /*    30 */    22,   11,   24,   13,   19,   15,    2,    3,   18,   22,
 /*    40 */    16,   24,   25,   17,   16,   22,   12,   24,   25,   22,
 /*    50 */    15,   24,   25,   23,   27,   22,   26,   24,   22,   22,
 /*    60 */    24,   24,   22,   18,   24,    2,    3,   17,   26,   23,
 /*    70 */    17,   27,   26,   26,
);
    const YY_SHIFT_USE_DFLT = -8;
    const YY_SHIFT_MAX = 26;
    static public $yy_shift_ofst = array(
 /*     0 */    11,   11,   11,   11,   11,   20,   11,   11,   11,   11,
 /*    10 */    45,   45,   -7,   45,   -4,    7,   34,   15,   63,    4,
 /*    20 */    24,   50,   53,   28,   26,    1,   35,
);
    const YY_REDUCE_USE_DFLT = -9;
    const YY_REDUCE_MAX = 13;
    static public $yy_reduce_ofst = array(
 /*     0 */    -8,   27,   17,    3,   23,   37,   36,   33,    8,   40,
 /*    10 */    46,   30,   42,   47,
);
    static public $yyExpectedTokens = array(
        /* 0 */ array(1, 11, 13, 18, ),
        /* 1 */ array(1, 11, 13, 18, ),
        /* 2 */ array(1, 11, 13, 18, ),
        /* 3 */ array(1, 11, 13, 18, ),
        /* 4 */ array(1, 11, 13, 18, ),
        /* 5 */ array(1, 11, 13, 15, 18, ),
        /* 6 */ array(1, 11, 13, 18, ),
        /* 7 */ array(1, 11, 13, 18, ),
        /* 8 */ array(1, 11, 13, 18, ),
        /* 9 */ array(1, 11, 13, 18, ),
        /* 10 */ array(18, ),
        /* 11 */ array(18, ),
        /* 12 */ array(15, 18, ),
        /* 13 */ array(18, ),
        /* 14 */ array(4, 5, 6, 7, 8, 9, 10, ),
        /* 15 */ array(0, 2, 3, 12, 16, 19, ),
        /* 16 */ array(2, 3, 12, ),
        /* 17 */ array(2, 3, 19, ),
        /* 18 */ array(2, 3, ),
        /* 19 */ array(16, ),
        /* 20 */ array(16, ),
        /* 21 */ array(17, ),
        /* 22 */ array(17, ),
        /* 23 */ array(16, ),
        /* 24 */ array(17, ),
        /* 25 */ array(14, ),
        /* 26 */ array(15, ),
        /* 27 */ array(),
        /* 28 */ array(),
        /* 29 */ array(),
        /* 30 */ array(),
        /* 31 */ array(),
        /* 32 */ array(),
        /* 33 */ array(),
        /* 34 */ array(),
        /* 35 */ array(),
        /* 36 */ array(),
        /* 37 */ array(),
        /* 38 */ array(),
        /* 39 */ array(),
        /* 40 */ array(),
        /* 41 */ array(),
        /* 42 */ array(),
        /* 43 */ array(),
);
    static public $yy_default = array(
 /*     0 */    66,   66,   66,   66,   66,   66,   66,   66,   66,   66,
 /*    10 */    66,   62,   66,   66,   66,   60,   66,   65,   44,   66,
 /*    20 */    66,   66,   66,   66,   66,   66,   66,   56,   63,   57,
 /*    30 */    47,   50,   51,   58,   55,   53,   61,   52,   48,   45,
 /*    40 */    64,   54,   49,   46,
);
/* The next thing included is series of defines which control
** various aspects of the generated parser.
**    self::YYNOCODE      is a number which corresponds
**                        to no legal terminal or nonterminal number.  This
**                        number is used to fill in empty slots of the hash 
**                        table.
**    self::YYFALLBACK    If defined, this indicates that one or more tokens
**                        have fall-back values which should be used if the
**                        original value of the token will not parse.
**    self::YYSTACKDEPTH  is the maximum depth of the parser's stack.
**    self::YYNSTATE      the combined number of states.
**    self::YYNRULE       the number of rules in the grammar
**    self::YYERRORSYMBOL is the code number of the error symbol.  If not
**                        defined, then do no error processing.
*/
    const YYNOCODE = 28;
    const YYSTACKDEPTH = 100;
    const YYNSTATE = 44;
    const YYNRULE = 22;
    const YYERRORSYMBOL = 20;
    const YYERRSYMDT = 'yy0';
    const YYFALLBACK = 0;
    /** The next table maps tokens into fallback tokens.  If a construct
     * like the following:
     * 
     *      %fallback ID X Y Z.
     *
     * appears in the grammer, then ID becomes a fallback token for X, Y,
     * and Z.  Whenever one of the tokens X, Y, or Z is input to the parser
     * but it does not parse, the type of the token is changed to ID and
     * the parse is retried before an error is thrown.
     */
    static public $yyFallback = array(
    );
    /**
     * Turn parser tracing on by giving a stream to which to write the trace
     * and a prompt to preface each trace message.  Tracing is turned off
     * by making either argument NULL 
     *
     * Inputs:
     * 
     * - A stream resource to which trace output should be written.
     *   If NULL, then tracing is turned off.
     * - A prefix string written at the beginning of every
     *   line of trace output.  If NULL, then tracing is
     *   turned off.
     *
     * Outputs:
     * 
     * - None.
     * @param resource
     * @param string
     */
    static function Trace($TraceFILE, $zTracePrompt)
    {
        if (!$TraceFILE) {
            $zTracePrompt = 0;
        } elseif (!$zTracePrompt) {
            $TraceFILE = 0;
        }
        self::$yyTraceFILE = $TraceFILE;
        self::$yyTracePrompt = $zTracePrompt;
    }

    /**
     * Output debug information to output (php://output stream)
     */
    static function PrintTrace()
    {
        self::$yyTraceFILE = fopen('php://output', 'w');
        self::$yyTracePrompt = '';
    }

    /**
     * @var resource|0
     */
    static public $yyTraceFILE;
    /**
     * String to prepend to debug output
     * @var string|0
     */
    static public $yyTracePrompt;
    /**
     * @var int
     */
    public $yyidx;                    /* Index of top element in stack */
    /**
     * @var int
     */
    public $yyerrcnt;                 /* Shifts left before out of the error */
    /**
     * @var array
     */
    public $yystack = array();  /* The parser's stack */

    /**
     * For tracing shifts, the names of all terminals and nonterminals
     * are required.  The following table supplies these names
     * @var array
     */
    static public $yyTokenName = array( 
  '$',             'NOT_OPERATOR',  'AND_OPERATOR',  'OR_OPERATOR', 
  'MIN_OPERATOR',  'MAX_OPERATOR',  'EXACTLY_OPERATOR',  'HAS_OPERATOR',
  'ONLYSOME_OPERATOR',  'ONLY_OPERATOR',  'SOME_OPERATOR',  'LPAREN',      
  'RPAREN',        'LBRACE',        'RBRACE',        'LSQUAREBRACKET',
  'RSQUAREBRACKET',  'NUMERIC',       'ALPHANUMERIC',  'COMMA',       
  'error',         'start',         'classExpr',     'enum',        
  'propExpr',      'list',          'instExpr',    
    );

    /**
     * For tracing reduce actions, the names of all rules are required.
     * @var array
     */
    static public $yyRuleName = array(
 /*   0 */ "start ::= classExpr",
 /*   1 */ "classExpr ::= LPAREN classExpr RPAREN",
 /*   2 */ "classExpr ::= LBRACE enum RBRACE",
 /*   3 */ "classExpr ::= propExpr ONLYSOME_OPERATOR LSQUAREBRACKET list RSQUAREBRACKET",
 /*   4 */ "classExpr ::= propExpr SOME_OPERATOR LSQUAREBRACKET list RSQUAREBRACKET",
 /*   5 */ "classExpr ::= propExpr ONLY_OPERATOR LSQUAREBRACKET list RSQUAREBRACKET",
 /*   6 */ "classExpr ::= classExpr AND_OPERATOR classExpr",
 /*   7 */ "classExpr ::= classExpr OR_OPERATOR classExpr",
 /*   8 */ "classExpr ::= propExpr SOME_OPERATOR classExpr",
 /*   9 */ "classExpr ::= NOT_OPERATOR classExpr",
 /*  10 */ "classExpr ::= propExpr ONLY_OPERATOR instExpr",
 /*  11 */ "classExpr ::= propExpr MIN_OPERATOR NUMERIC",
 /*  12 */ "classExpr ::= propExpr MAX_OPERATOR NUMERIC",
 /*  13 */ "classExpr ::= propExpr EXACTLY_OPERATOR NUMERIC",
 /*  14 */ "classExpr ::= propExpr HAS_OPERATOR instExpr",
 /*  15 */ "classExpr ::= ALPHANUMERIC",
 /*  16 */ "propExpr ::= ALPHANUMERIC",
 /*  17 */ "enum ::= instExpr enum",
 /*  18 */ "enum ::= instExpr",
 /*  19 */ "instExpr ::= ALPHANUMERIC",
 /*  20 */ "list ::= classExpr COMMA list",
 /*  21 */ "list ::= classExpr",
    );

    /**
     * This function returns the symbolic name associated with a token
     * value.
     * @param int
     * @return string
     */
    function tokenName($tokenType)
    {
        if ($tokenType === 0) {
            return 'End of Input';
        }
        if ($tokenType > 0 && $tokenType < count(self::$yyTokenName)) {
            return self::$yyTokenName[$tokenType];
        } else {
            return "Unknown";
        }
    }

    /**
     * The following function deletes the value associated with a
     * symbol.  The symbol can be either a terminal or nonterminal.
     * @param int the symbol code
     * @param mixed the symbol's value
     */
    static function yy_destructor($yymajor, $yypminor)
    {
        switch ($yymajor) {
        /* Here is inserted the actions which take place when a
        ** terminal or non-terminal is destroyed.  This can happen
        ** when the symbol is popped from the stack during a
        ** reduce or during error processing or when a parser is 
        ** being destroyed before it is finished parsing.
        **
        ** Note: during a reduce, the only symbols destroyed are those
        ** which appear on the RHS of the rule, but which are not used
        ** inside the C code.
        */
            default:  break;   /* If no destructor action specified: do nothing */
        }
    }

    /**
     * Pop the parser's stack once.
     *
     * If there is a destructor routine associated with the token which
     * is popped from the stack, then call it.
     *
     * Return the major token number for the symbol popped.
     * @param OWL_To_Erfurt_yyParser
     * @return int
     */
    function yy_pop_parser_stack()
    {
        if (!count($this->yystack)) {
            return;
        }
        $yytos = array_pop($this->yystack);
        if (self::$yyTraceFILE && $this->yyidx >= 0) {
            fwrite(self::$yyTraceFILE,
                self::$yyTracePrompt . 'Popping ' . self::$yyTokenName[$yytos->major] .
                    "\n");
        }
        $yymajor = $yytos->major;
        self::yy_destructor($yymajor, $yytos->minor);
        $this->yyidx--;
        return $yymajor;
    }

    /**
     * Deallocate and destroy a parser.  Destructors are all called for
     * all stack elements before shutting the parser down.
     */
    function __destruct()
    {
        while ($this->yyidx >= 0) {
            $this->yy_pop_parser_stack();
        }
        if (is_resource(self::$yyTraceFILE)) {
            fclose(self::$yyTraceFILE);
        }
    }

    /**
     * Based on the current state and parser stack, get a list of all
     * possible lookahead tokens
     * @param int
     * @return array
     */
    function yy_get_expected_tokens($token)
    {
        $state = $this->yystack[$this->yyidx]->stateno;
        $expected = self::$yyExpectedTokens[$state];
        if (in_array($token, self::$yyExpectedTokens[$state], true)) {
            return $expected;
        }
        $stack = $this->yystack;
        $yyidx = $this->yyidx;
        do {
            $yyact = $this->yy_find_shift_action($token);
            if ($yyact >= self::YYNSTATE && $yyact < self::YYNSTATE + self::YYNRULE) {
                // reduce action
                $done = 0;
                do {
                    if ($done++ == 100) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // too much recursion prevents proper detection
                        // so give up
                        return array_unique($expected);
                    }
                    $yyruleno = $yyact - self::YYNSTATE;
                    $this->yyidx -= self::$yyRuleInfo[$yyruleno]['rhs'];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[$this->yyidx]->stateno,
                        self::$yyRuleInfo[$yyruleno]['lhs']);
                    if (isset(self::$yyExpectedTokens[$nextstate])) {
                        $expected += self::$yyExpectedTokens[$nextstate];
                            if (in_array($token,
                                  self::$yyExpectedTokens[$nextstate], true)) {
                            $this->yyidx = $yyidx;
                            $this->yystack = $stack;
                            return array_unique($expected);
                        }
                    }
                    if ($nextstate < self::YYNSTATE) {
                        // we need to shift a non-terminal
                        $this->yyidx++;
                        $x = new OWL_To_Erfurt_yyStackEntry;
                        $x->stateno = $nextstate;
                        $x->major = self::$yyRuleInfo[$yyruleno]['lhs'];
                        $this->yystack[$this->yyidx] = $x;
                        continue 2;
                    } elseif ($nextstate == self::YYNSTATE + self::YYNRULE + 1) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // the last token was just ignored, we can't accept
                        // by ignoring input, this is in essence ignoring a
                        // syntax error!
                        return array_unique($expected);
                    } elseif ($nextstate === self::YY_NO_ACTION) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // input accepted, but not shifted (I guess)
                        return $expected;
                    } else {
                        $yyact = $nextstate;
                    }
                } while (true);
            }
            break;
        } while (true);
        return array_unique($expected);
    }

    /**
     * Based on the parser state and current parser stack, determine whether
     * the lookahead token is possible.
     * 
     * The parser will convert the token value to an error token if not.  This
     * catches some unusual edge cases where the parser would fail.
     * @param int
     * @return bool
     */
    function yy_is_expected_token($token)
    {
        if ($token === 0) {
            return true; // 0 is not part of this
        }
        $state = $this->yystack[$this->yyidx]->stateno;
        if (in_array($token, self::$yyExpectedTokens[$state], true)) {
            return true;
        }
        $stack = $this->yystack;
        $yyidx = $this->yyidx;
        do {
            $yyact = $this->yy_find_shift_action($token);
            if ($yyact >= self::YYNSTATE && $yyact < self::YYNSTATE + self::YYNRULE) {
                // reduce action
                $done = 0;
                do {
                    if ($done++ == 100) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // too much recursion prevents proper detection
                        // so give up
                        return true;
                    }
                    $yyruleno = $yyact - self::YYNSTATE;
                    $this->yyidx -= self::$yyRuleInfo[$yyruleno]['rhs'];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[$this->yyidx]->stateno,
                        self::$yyRuleInfo[$yyruleno]['lhs']);
                    if (isset(self::$yyExpectedTokens[$nextstate]) &&
                          in_array($token, self::$yyExpectedTokens[$nextstate], true)) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        return true;
                    }
                    if ($nextstate < self::YYNSTATE) {
                        // we need to shift a non-terminal
                        $this->yyidx++;
                        $x = new OWL_To_Erfurt_yyStackEntry;
                        $x->stateno = $nextstate;
                        $x->major = self::$yyRuleInfo[$yyruleno]['lhs'];
                        $this->yystack[$this->yyidx] = $x;
                        continue 2;
                    } elseif ($nextstate == self::YYNSTATE + self::YYNRULE + 1) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        if (!$token) {
                            // end of input: this is valid
                            return true;
                        }
                        // the last token was just ignored, we can't accept
                        // by ignoring input, this is in essence ignoring a
                        // syntax error!
                        return false;
                    } elseif ($nextstate === self::YY_NO_ACTION) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // input accepted, but not shifted (I guess)
                        return true;
                    } else {
                        $yyact = $nextstate;
                    }
                } while (true);
            }
            break;
        } while (true);
        $this->yyidx = $yyidx;
        $this->yystack = $stack;
        return true;
    }

    /**
     * Find the appropriate action for a parser given the terminal
     * look-ahead token iLookAhead.
     *
     * If the look-ahead token is YYNOCODE, then check to see if the action is
     * independent of the look-ahead.  If it is, return the action, otherwise
     * return YY_NO_ACTION.
     * @param int The look-ahead token
     */
    function yy_find_shift_action($iLookAhead)
    {
        $stateno = $this->yystack[$this->yyidx]->stateno;
     
        /* if ($this->yyidx < 0) return self::YY_NO_ACTION;  */
        if (!isset(self::$yy_shift_ofst[$stateno])) {
            // no shift actions
            return self::$yy_default[$stateno];
        }
        $i = self::$yy_shift_ofst[$stateno];
        if ($i === self::YY_SHIFT_USE_DFLT) {
            return self::$yy_default[$stateno];
        }
        if ($iLookAhead == self::YYNOCODE) {
            return self::YY_NO_ACTION;
        }
        $i += $iLookAhead;
        if ($i < 0 || $i >= self::YY_SZ_ACTTAB ||
              self::$yy_lookahead[$i] != $iLookAhead) {
            if (count(self::$yyFallback) && $iLookAhead < count(self::$yyFallback)
                   && ($iFallback = self::$yyFallback[$iLookAhead]) != 0) {
                if (self::$yyTraceFILE) {
                    fwrite(self::$yyTraceFILE, self::$yyTracePrompt . "FALLBACK " .
                        self::$yyTokenName[$iLookAhead] . " => " .
                        self::$yyTokenName[$iFallback] . "\n");
                }
                return $this->yy_find_shift_action($iFallback);
            }
            return self::$yy_default[$stateno];
        } else {
            return self::$yy_action[$i];
        }
    }

    /**
     * Find the appropriate action for a parser given the non-terminal
     * look-ahead token $iLookAhead.
     *
     * If the look-ahead token is self::YYNOCODE, then check to see if the action is
     * independent of the look-ahead.  If it is, return the action, otherwise
     * return self::YY_NO_ACTION.
     * @param int Current state number
     * @param int The look-ahead token
     */
    function yy_find_reduce_action($stateno, $iLookAhead)
    {
        /* $stateno = $this->yystack[$this->yyidx]->stateno; */

        if (!isset(self::$yy_reduce_ofst[$stateno])) {
            return self::$yy_default[$stateno];
        }
        $i = self::$yy_reduce_ofst[$stateno];
        if ($i == self::YY_REDUCE_USE_DFLT) {
            return self::$yy_default[$stateno];
        }
        if ($iLookAhead == self::YYNOCODE) {
            return self::YY_NO_ACTION;
        }
        $i += $iLookAhead;
        if ($i < 0 || $i >= self::YY_SZ_ACTTAB ||
              self::$yy_lookahead[$i] != $iLookAhead) {
            return self::$yy_default[$stateno];
        } else {
            return self::$yy_action[$i];
        }
    }

    /**
     * Perform a shift action.
     * @param int The new state to shift in
     * @param int The major token to shift in
     * @param mixed the minor token to shift in
     */
    function yy_shift($yyNewState, $yyMajor, $yypMinor)
    {
        $this->yyidx++;
        if ($this->yyidx >= self::YYSTACKDEPTH) {
            $this->yyidx--;
            if (self::$yyTraceFILE) {
                fprintf(self::$yyTraceFILE, "%sStack Overflow!\n", self::$yyTracePrompt);
            }
            while ($this->yyidx >= 0) {
                $this->yy_pop_parser_stack();
            }
            /* Here code is inserted which will execute if the parser
            ** stack ever overflows */
            return;
        }
        $yytos = new OWL_To_Erfurt_yyStackEntry;
        $yytos->stateno = $yyNewState;
        $yytos->major = $yyMajor;
        $yytos->minor = $yypMinor;
        array_push($this->yystack, $yytos);
        if (self::$yyTraceFILE && $this->yyidx > 0) {
            fprintf(self::$yyTraceFILE, "%sShift %d\n", self::$yyTracePrompt,
                $yyNewState);
            fprintf(self::$yyTraceFILE, "%sStack:", self::$yyTracePrompt);
            for($i = 1; $i <= $this->yyidx; $i++) {
                fprintf(self::$yyTraceFILE, " %s",
                    self::$yyTokenName[$this->yystack[$i]->major]);
            }
            fwrite(self::$yyTraceFILE,"\n");
        }
    }

    /**
     * The following table contains information about every rule that
     * is used during the reduce.
     *
     * <pre>
     * array(
     *  array(
     *   int $lhs;         Symbol on the left-hand side of the rule
     *   int $nrhs;     Number of right-hand side symbols in the rule
     *  ),...
     * );
     * </pre>
     */
    static public $yyRuleInfo = array(
  array( 'lhs' => 21, 'rhs' => 1 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 5 ),
  array( 'lhs' => 22, 'rhs' => 5 ),
  array( 'lhs' => 22, 'rhs' => 5 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 2 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 3 ),
  array( 'lhs' => 22, 'rhs' => 1 ),
  array( 'lhs' => 24, 'rhs' => 1 ),
  array( 'lhs' => 23, 'rhs' => 2 ),
  array( 'lhs' => 23, 'rhs' => 1 ),
  array( 'lhs' => 26, 'rhs' => 1 ),
  array( 'lhs' => 25, 'rhs' => 3 ),
  array( 'lhs' => 25, 'rhs' => 1 ),
    );

    /**
     * The following table contains a mapping of reduce action to method name
     * that handles the reduction.
     * 
     * If a rule is not set, it has no handler.
     */
    static public $yyReduceMap = array(
        0 => 0,
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 18,
        21 => 18,
        19 => 19,
        20 => 20,
    );
    /* Beginning here are the reduction cases.  A typical example
    ** follows:
    **  #line <lineno> <grammarfile>
    **   function yy_r0($yymsp){ ... }           // User supplied code
    **  #line <lineno> <thisfile>
    */
#line 38 "./Parser.y"
    function yy_r0(){
		print_r($this->yystack[$this->yyidx + 0]->minor->generateRDF()->writeAsHtmlTable());    }
#line 861 "./Parser.php"
#line 43 "./Parser.y"
    function yy_r1(){
		$this->_retvalue=$this->yystack[$this->yyidx + -1]->minor;    }
#line 865 "./Parser.php"
#line 46 "./Parser.y"
    function yy_r2(){
		$this->_retvalue= new Erfurt_Owl_Structured_EnumeratedClass($this->yystack[$this->yyidx + -1]->minor);    }
#line 869 "./Parser.php"
#line 49 "./Parser.y"
    function yy_r3(){
		$this->_retvalue = new Erfurt_Owl_Structured_IntersectionClass($this->yystack[$this->yyidx + -4]->minor ." onlysome ". $this->yystack[$this->yyidx + -1]->minor);
		foreach ($this->yystack[$this->yyidx + -1]->minor as $value) {
			$this->_retvalue->addChildClass(new Erfurt_Owl_Structured_SomeValuesFrom($this->yystack[$this->yyidx + -4]->minor . " some " . $this->yystack[$this->yyidx + -1]->minor,$this->yystack[$this->yyidx + -4]->minor,$value));}
		$x=new Erfurt_Owl_Structured_UnionClass("".$this->yystack[$this->yyidx + -1]->minor);
		$x->addChildClass($this->yystack[$this->yyidx + -1]->minor);
		$this->_retvalue->addChildClass(new Erfurt_Owl_Structured_AllValuesFrom($this->yystack[$this->yyidx + -4]->minor." only ".$this->yystack[$this->yyidx + -1]->minor,$this->yystack[$this->yyidx + -4]->minor,$x));    }
#line 878 "./Parser.php"
#line 57 "./Parser.y"
    function yy_r4(){
		$this->_retvalue=new Erfurt_Owl_Structured_SomeValuesFrom($this->yystack[$this->yyidx + -4]->minor." some ".$this->yystack[$this->yyidx + -1]->minor,$this->yystack[$this->yyidx + -4]->minor,$this->yystack[$this->yyidx + -1]->minor);
		    }
#line 883 "./Parser.php"
#line 61 "./Parser.y"
    function yy_r5(){
		$this->_retvalue=new Erfurt_Owl_Structured_AllValuesFrom($this->yystack[$this->yyidx + -4]->minor." some ".$this->yystack[$this->yyidx + -1]->minor,$this->yystack[$this->yyidx + -4]->minor,$this->yystack[$this->yyidx + -1]->minor);
		    }
#line 888 "./Parser.php"
#line 65 "./Parser.y"
    function yy_r6(){
		$this->_retvalue = new Erfurt_Owl_Structured_IntersectionClass($this->yystack[$this->yyidx + -2]->minor->getURI()." and ".$this->yystack[$this->yyidx + 0]->minor->getURI());
		if($this->yystack[$this->yyidx + -2]->minor instanceof Erfurt_Owl_Structured_IntersectionClass){
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + -2]->minor->getChildClasses());
		}else{
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + -2]->minor);
		}
		if($this->yystack[$this->yyidx + 0]->minor instanceof Erfurt_Owl_Structured_IntersectionClass){
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + 0]->minor->getChildClasses());
		}else{
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + 0]->minor);
		}
		    }
#line 903 "./Parser.php"
#line 79 "./Parser.y"
    function yy_r7(){
		$this->_retvalue = new Erfurt_Owl_Structured_UnionClass($this->yystack[$this->yyidx + -2]->minor->getURI()." or ".$this->yystack[$this->yyidx + 0]->minor->getURI());
		if($this->yystack[$this->yyidx + -2]->minor instanceof Erfurt_Owl_Structured_UnionClass){
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + -2]->minor->getChildClasses());
		}else{
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + -2]->minor);
		}
		if($this->yystack[$this->yyidx + 0]->minor instanceof Erfurt_Owl_Structured_UnionClass){
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + 0]->minor->getChildClasses());
		}else{
			$this->_retvalue->addChildClass($this->yystack[$this->yyidx + 0]->minor);
		}
		    }
#line 918 "./Parser.php"
#line 93 "./Parser.y"
    function yy_r8(){ 
		$this->_retvalue = new Erfurt_Owl_Structured_SomeValuesFrom($this->yystack[$this->yyidx + -2]->minor . " some " . $this->yystack[$this->yyidx + 0]->minor->getURI(),$this->yystack[$this->yyidx + -2]->minor,$this->yystack[$this->yyidx + 0]->minor);    }
#line 922 "./Parser.php"
#line 96 "./Parser.y"
    function yy_r9(){
		$this->_retvalue = new Erfurt_Owl_Structured_ComplementClass($this->yystack[$this->yyidx + 0]->minor);    }
#line 926 "./Parser.php"
#line 99 "./Parser.y"
    function yy_r10(){
		$this->_retvalue = new Erfurt_Owl_Structured_AllValuesFrom($this->yystack[$this->yyidx + -2]->minor." only ".$this->yystack[$this->yyidx + 0]->minor,$this->yystack[$this->yyidx + -2]->minor,$this->yystack[$this->yyidx + 0]->minor);    }
#line 930 "./Parser.php"
#line 102 "./Parser.y"
    function yy_r11(){
		$this->_retvalue = new Erfurt_Owl_Structured_MinCardinality($this->yystack[$this->yyidx + -2]->minor." min ".$this->yystack[$this->yyidx + 0]->minor, $this->yystack[$this->yyidx + -2]->minor, $this->yystack[$this->yyidx + 0]->minor);    }
#line 934 "./Parser.php"
#line 105 "./Parser.y"
    function yy_r12(){
		$this->_retvalue = new Erfurt_Owl_Structured_MaxCardinality($this->yystack[$this->yyidx + -2]->minor." max ".$this->yystack[$this->yyidx + 0]->minor, $this->yystack[$this->yyidx + -2]->minor, $this->yystack[$this->yyidx + 0]->minor);    }
#line 938 "./Parser.php"
#line 108 "./Parser.y"
    function yy_r13(){
		$this->_retvalue = new Erfurt_Owl_Structured_Cardinality($this->yystack[$this->yyidx + -2]->minor." exactly ".$this->yystack[$this->yyidx + 0]->minor, $this->yystack[$this->yyidx + -2]->minor, $this->yystack[$this->yyidx + 0]->minor);    }
#line 942 "./Parser.php"
#line 111 "./Parser.y"
    function yy_r14(){
		$this->_retvalue = new Erfurt_Owl_Structured_HasValue($this->yystack[$this->yyidx + -2]->minor." has ".$this->yystack[$this->yyidx + 0]->minor, $this->yystack[$this->yyidx + -2]->minor, $this->yystack[$this->yyidx + 0]->minor);     }
#line 946 "./Parser.php"
#line 114 "./Parser.y"
    function yy_r15(){
		$this->_retvalue =new Erfurt_Owl_Structured_NamedClass($this->yystack[$this->yyidx + 0]->minor);    }
#line 950 "./Parser.php"
#line 117 "./Parser.y"
    function yy_r16(){
		$this->_retvalue = $this->yystack[$this->yyidx + 0]->minor;    }
#line 954 "./Parser.php"
#line 120 "./Parser.y"
    function yy_r17(){
		$this->_retvalue=array_merge(array($this->yystack[$this->yyidx + -1]->minor),$this->yystack[$this->yyidx + 0]->minor);    }
#line 958 "./Parser.php"
#line 123 "./Parser.y"
    function yy_r18(){
		$this->_retvalue=array($this->yystack[$this->yyidx + 0]->minor);    }
#line 962 "./Parser.php"
#line 126 "./Parser.y"
    function yy_r19(){
		$this->_retvalue = new Erfurt_Owl_Structured_Instance($this->yystack[$this->yyidx + 0]->minor);    }
#line 966 "./Parser.php"
#line 129 "./Parser.y"
    function yy_r20(){
		$this->_retvalue= array_merge(array($this->yystack[$this->yyidx + -2]->minor),$this->yystack[$this->yyidx + 0]->minor);    }
#line 970 "./Parser.php"

    /**
     * placeholder for the left hand side in a reduce operation.
     * 
     * For a parser with a rule like this:
     * <pre>
     * rule(A) ::= B. { A = 1; }
     * </pre>
     * 
     * The parser will translate to something like:
     * 
     * <code>
     * function yy_r0(){$this->_retvalue = 1;}
     * </code>
     */
    private $_retvalue;

    /**
     * Perform a reduce action and the shift that must immediately
     * follow the reduce.
     * 
     * For a rule such as:
     * 
     * <pre>
     * A ::= B blah C. { dosomething(); }
     * </pre>
     * 
     * This function will first call the action, if any, ("dosomething();" in our
     * example), and then it will pop three states from the stack,
     * one for each entry on the right-hand side of the expression
     * (B, blah, and C in our example rule), and then push the result of the action
     * back on to the stack with the resulting state reduced to (as described in the .out
     * file)
     * @param int Number of the rule by which to reduce
     */
    function yy_reduce($yyruleno)
    {
        //int $yygoto;                     /* The next state */
        //int $yyact;                      /* The next action */
        //mixed $yygotominor;        /* The LHS of the rule reduced */
        //OWL_To_Erfurt_yyStackEntry $yymsp;            /* The top of the parser's stack */
        //int $yysize;                     /* Amount to pop the stack */
        $yymsp = $this->yystack[$this->yyidx];
        if (self::$yyTraceFILE && $yyruleno >= 0 
              && $yyruleno < count(self::$yyRuleName)) {
            fprintf(self::$yyTraceFILE, "%sReduce (%d) [%s].\n",
                self::$yyTracePrompt, $yyruleno,
                self::$yyRuleName[$yyruleno]);
        }

        $this->_retvalue = $yy_lefthand_side = null;
        if (array_key_exists($yyruleno, self::$yyReduceMap)) {
            // call the action
            $this->_retvalue = null;
            $this->{'yy_r' . self::$yyReduceMap[$yyruleno]}();
            $yy_lefthand_side = $this->_retvalue;
        }
        $yygoto = self::$yyRuleInfo[$yyruleno]['lhs'];
        $yysize = self::$yyRuleInfo[$yyruleno]['rhs'];
        $this->yyidx -= $yysize;
        for($i = $yysize; $i; $i--) {
            // pop all of the right-hand side parameters
            array_pop($this->yystack);
        }
        $yyact = $this->yy_find_reduce_action($this->yystack[$this->yyidx]->stateno, $yygoto);
        if ($yyact < self::YYNSTATE) {
            /* If we are not debugging and the reduce action popped at least
            ** one element off the stack, then we can push the new element back
            ** onto the stack here, and skip the stack overflow test in yy_shift().
            ** That gives a significant speed improvement. */
            if (!self::$yyTraceFILE && $yysize) {
                $this->yyidx++;
                $x = new OWL_To_Erfurt_yyStackEntry;
                $x->stateno = $yyact;
                $x->major = $yygoto;
                $x->minor = $yy_lefthand_side;
                $this->yystack[$this->yyidx] = $x;
            } else {
                $this->yy_shift($yyact, $yygoto, $yy_lefthand_side);
            }
        } elseif ($yyact == self::YYNSTATE + self::YYNRULE + 1) {
            $this->yy_accept();
        }
    }

    /**
     * The following code executes when the parse fails
     * 
     * Code from %parse_fail is inserted here
     */
    function yy_parse_failed()
    {
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sFail!\n", self::$yyTracePrompt);
        }
        while ($this->yyidx >= 0) {
            $this->yy_pop_parser_stack();
        }
        /* Here code is inserted which will be executed whenever the
        ** parser fails */
    }

    /**
     * The following code executes when a syntax error first occurs.
     * 
     * %syntax_error code is inserted here
     * @param int The major type of the error token
     * @param mixed The minor type of the error token
     */
    function yy_syntax_error($yymajor, $TOKEN)
    {
#line 24 "./Parser.y"

    echo "Syntax Error in token '" . 
        $this->lex->value."'\n";
    foreach ($this->yystack as $entry) {
        echo $this->tokenName($entry->major) . ' ';
    }
    foreach ($this->yy_get_expected_tokens($yymajor) as $token) {
        $expect[] = self::$yyTokenName[$token];
    }
	echo ('Unexpected ' . $this->tokenName($yymajor) . '(' . $TOKEN
        . '), expected one of: ' . implode(',', $expect) . "\n");
    exit(1);
#line 1096 "./Parser.php"
    }

    /**
     * The following is executed when the parser accepts
     * 
     * %parse_accept code is inserted here
     */
    function yy_accept()
    {
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sAccept!\n", self::$yyTracePrompt);
        }
        while ($this->yyidx >= 0) {
            $stack = $this->yy_pop_parser_stack();
        }
        /* Here code is inserted which will be executed whenever the
        ** parser accepts */
    }

    /**
     * The main parser program.
     * 
     * The first argument is the major token number.  The second is
     * the token value string as scanned from the input.
     *
     * @param int the token number
     * @param mixed the token value
     * @param mixed any extra arguments that should be passed to handlers
     */
    function doParse($yymajor, $yytokenvalue)
    {
//        $yyact;            /* The parser action. */
//        $yyendofinput;     /* True if we are at the end of input */
        $yyerrorhit = 0;   /* True if yymajor has invoked an error */
        
        /* (re)initialize the parser, if necessary */
        if ($this->yyidx === null || $this->yyidx < 0) {
            /* if ($yymajor == 0) return; // not sure why this was here... */
            $this->yyidx = 0;
            $this->yyerrcnt = -1;
            $x = new OWL_To_Erfurt_yyStackEntry;
            $x->stateno = 0;
            $x->major = 0;
            $this->yystack = array();
            array_push($this->yystack, $x);
        }
        $yyendofinput = ($yymajor==0);
        
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sInput %s\n",
                self::$yyTracePrompt, self::$yyTokenName[$yymajor]);
        }
        
        do {
            $yyact = $this->yy_find_shift_action($yymajor);
            if ($yymajor < self::YYERRORSYMBOL &&
                  !$this->yy_is_expected_token($yymajor)) {
                // force a syntax error
                $yyact = self::YY_ERROR_ACTION;
            }
            if ($yyact < self::YYNSTATE) {
                $this->yy_shift($yyact, $yymajor, $yytokenvalue);
                $this->yyerrcnt--;
                if ($yyendofinput && $this->yyidx >= 0) {
                    $yymajor = 0;
                } else {
                    $yymajor = self::YYNOCODE;
                }
            } elseif ($yyact < self::YYNSTATE + self::YYNRULE) {
                $this->yy_reduce($yyact - self::YYNSTATE);
            } elseif ($yyact == self::YY_ERROR_ACTION) {
                if (self::$yyTraceFILE) {
                    fprintf(self::$yyTraceFILE, "%sSyntax Error!\n",
                        self::$yyTracePrompt);
                }
                if (self::YYERRORSYMBOL) {
                    /* A syntax error has occurred.
                    ** The response to an error depends upon whether or not the
                    ** grammar defines an error token "ERROR".  
                    **
                    ** This is what we do if the grammar does define ERROR:
                    **
                    **  * Call the %syntax_error function.
                    **
                    **  * Begin popping the stack until we enter a state where
                    **    it is legal to shift the error symbol, then shift
                    **    the error symbol.
                    **
                    **  * Set the error count to three.
                    **
                    **  * Begin accepting and shifting new tokens.  No new error
                    **    processing will occur until three tokens have been
                    **    shifted successfully.
                    **
                    */
                    if ($this->yyerrcnt < 0) {
                        $this->yy_syntax_error($yymajor, $yytokenvalue);
                    }
                    $yymx = $this->yystack[$this->yyidx]->major;
                    if ($yymx == self::YYERRORSYMBOL || $yyerrorhit ){
                        if (self::$yyTraceFILE) {
                            fprintf(self::$yyTraceFILE, "%sDiscard input token %s\n",
                                self::$yyTracePrompt, self::$yyTokenName[$yymajor]);
                        }
                        $this->yy_destructor($yymajor, $yytokenvalue);
                        $yymajor = self::YYNOCODE;
                    } else {
                        while ($this->yyidx >= 0 &&
                                 $yymx != self::YYERRORSYMBOL &&
        ($yyact = $this->yy_find_shift_action(self::YYERRORSYMBOL)) >= self::YYNSTATE
                              ){
                            $this->yy_pop_parser_stack();
                        }
                        if ($this->yyidx < 0 || $yymajor==0) {
                            $this->yy_destructor($yymajor, $yytokenvalue);
                            $this->yy_parse_failed();
                            $yymajor = self::YYNOCODE;
                        } elseif ($yymx != self::YYERRORSYMBOL) {
                            $u2 = 0;
                            $this->yy_shift($yyact, self::YYERRORSYMBOL, $u2);
                        }
                    }
                    $this->yyerrcnt = 3;
                    $yyerrorhit = 1;
                } else {
                    /* YYERRORSYMBOL is not defined */
                    /* This is what we do if the grammar does not define ERROR:
                    **
                    **  * Report an error message, and throw away the input token.
                    **
                    **  * If the input token is $, then fail the parse.
                    **
                    ** As before, subsequent error messages are suppressed until
                    ** three input tokens have been successfully shifted.
                    */
                    if ($this->yyerrcnt <= 0) {
                        $this->yy_syntax_error($yymajor, $yytokenvalue);
                    }
                    $this->yyerrcnt = 3;
                    $this->yy_destructor($yymajor, $yytokenvalue);
                    if ($yyendofinput) {
                        $this->yy_parse_failed();
                    }
                    $yymajor = self::YYNOCODE;
                }
            } else {
                $this->yy_accept();
                $yymajor = self::YYNOCODE;
            }            
        } while ($yymajor != self::YYNOCODE && $this->yyidx >= 0);
    }
}