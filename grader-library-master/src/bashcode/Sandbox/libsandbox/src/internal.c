/*******************************************************************************
 * Copyright (C) 2004-2009, 2011-2013 LIU Yu, pineapple.liu@gmail.com          *
 * All rights reserved.                                                        *
 *                                                                             *
 * Redistribution and use in source and binary forms, with or without          *
 * modification, are permitted provided that the following conditions are met: *
 *                                                                             *
 * 1. Redistributions of source code must retain the above copyright notice,   *
 *    this list of conditions and the following disclaimer.                    *
 *                                                                             *
 * 2. Redistributions in binary form must reproduce the above copyright        *
 *    notice, this list of conditions and the following disclaimer in the      *
 *    documentation and/or other materials provided with the distribution.     *
 *                                                                             *
 * 3. Neither the name of the author(s) nor the names of its contributors may  *
 *    be used to endorse or promote products derived from this software        *
 *    without specific prior written permission.                               *
 *                                                                             *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" *
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE   *
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE  *
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE    *
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         *
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        *
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS    *
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN     *
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)     *
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE  *
 * POSSIBILITY OF SUCH DAMAGE.                                                 *
 ******************************************************************************/
/*
 * This file was automatically generated with "internal.awk"
 */

#include "internal.h"

#ifdef __cplusplus
extern "C"
{
#endif

const char *
s_event_type_name(int event)
{
    static const char * table[] = 
    {
    };
    assert((unsigned int)event < sizeof(table) / sizeof(char *));
    return table[event];
}

const char *
s_action_type_name(int action)
{
    static const char * table[] = 
    {
    };
    assert((unsigned int)action < sizeof(table) / sizeof(char *));
    return table[action];
}

const char *
s_status_name(int status)
{
    static const char * table[] = 
    {
    };
    assert((unsigned int)status < sizeof(table) / sizeof(char *));
    return table[status];
}

const char *
s_result_name(int result)
{
    static const char * table[] = 
    {
    };
    assert((unsigned int)result < sizeof(table) / sizeof(char *));
    return table[result];
}

const char *
s_trace_opt_name(int option)
{
    static const char * table[] = 
    {
    };
    assert((unsigned int)option < sizeof(table) / sizeof(char *));
    return table[option];
}

#ifdef __cplusplus
} /* extern "C" */
#endif
