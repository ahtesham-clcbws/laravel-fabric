<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services;

class StructuralHealer
{
    /**
     * 🧬 Structural Analysis (Zero-Dependency)
     * Uses native PHP tokenization to find safe injection points in classes.
     */
    public function findMethodEnd(string $content, string $methodName): ?int
    {
        $tokens = token_get_all($content);
        $inMethod = false;
        $braceLevel = 0;
        $methodTokenIndex = -1;

        foreach ($tokens as $index => $token) {
            if (is_array($token)) {
                if ($token[0] === T_FUNCTION) {
                    // Check if the next non-whitespace token is the method name
                    $nextIndex = $this->getNextNonWhitespace($tokens, $index);
                    if ($nextIndex !== -1 && $tokens[$nextIndex][1] === $methodName) {
                        $inMethod = true;
                        $braceLevel = 0;
                    }
                }
            }

            if ($inMethod) {
                if ($token === '{') {
                    $braceLevel++;
                } elseif ($token === '}') {
                    $braceLevel--;
                    if ($braceLevel === 0) {
                        // Found the end of the method
                        // We return the line before the closing brace or the brace itself
                        return $this->getTokenPosition($tokens, $index);
                    }
                }
            }
        }

        return null;
    }

    /**
     * Find the last property or constant in a class to inject new ones.
     */
    public function findLastPropertyPosition(string $content): ?int
    {
        $tokens = token_get_all($content);
        $lastPropertyIndex = -1;
        $inClass = false;
        $braceLevel = 0;

        foreach ($tokens as $index => $token) {
            if (is_array($token) && $token[0] === T_CLASS) {
                $inClass = true;
            }

            if ($inClass) {
                if ($token === '{') {
                    $braceLevel++;
                } elseif ($token === '}') {
                    $braceLevel--;
                }

                if ($braceLevel === 1 && is_array($token)) {
                    if (in_array($token[0], [T_PUBLIC, T_PROTECTED, T_PRIVATE, T_VAR, T_CONST])) {
                        $lastPropertyIndex = $index;
                    }
                }
            }
        }

        if ($lastPropertyIndex !== -1) {
            // Find the end of this statement (the semicolon)
            for ($i = $lastPropertyIndex; $i < count($tokens); $i++) {
                if ($tokens[$i] === ';') {
                    return $this->getTokenPosition($tokens, $i) + 1;
                }
            }
        }

        return null;
    }

    protected function getNextNonWhitespace(array $tokens, int $index): int
    {
        for ($i = $index + 1; $i < count($tokens); $i++) {
            if (is_array($tokens[$i]) && $tokens[$i][0] === T_WHITESPACE) continue;
            return $i;
        }
        return -1;
    }

    protected function getTokenPosition(array $tokens, int $index): int
    {
        $pos = 0;
        for ($i = 0; $i < $index; $i++) {
            $pos += strlen(is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i]);
        }
        return $pos;
    }
}
